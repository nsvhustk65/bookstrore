<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OderController extends Controller
{
    public function process(Request $request)
    {
        // Dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'payment_method' => 'required',
        ]);

        // Lấy giỏ hàng từ session
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // Tạo mã đơn hàng ngẫu nhiên
        $orderCode = strtoupper(Str::random(10)); // Ví dụ: tạo mã 10 ký tự chữ hoa ngẫu nhiên

        // Lấy tổng tiền đã tính từ phía view (giả sử tổng tiền, phí ship đã có trong biến $total)
        $tienHang = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);

        // Tính phí vận chuyển
        $shipping = 30000;  // Ví dụ phí vận chuyển cố định
        $total = $tienHang + $shipping;

        // Tạo đơn hàng
        $order = Order::create([
            'ma_don_hang' => $orderCode,
            'user_id' => auth::id(),
            'ten_nguoi_nhan' => $validated['name'],
            'phone_nguoi_nhan' => $validated['phone'],
            'email_nguoi_nhan' => $validated['email'],
            'address_nguoi_nhan' => $validated['address'],
            'tien_hang' => $tienHang,
            'tien_ship' => $shipping,
            'tong_tien' => $total,
            'trang_thai_thanh_toan' => $validated['payment_method'] === 'COD' ? 'COD' : 'Online',
        ]);

        // Lưu các sản phẩm trong giỏ hàng vào bảng order_items
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'so_luong' => $item['quantity'],
                'don_gia' => $item['price'],
                'thanh_tien' => $total,
            ]);
        }

        // Xử lý phương thức thanh toán
        if ($validated['payment_method'] === 'COD') {
            // Xóa giỏ hàng khỏi session
            $request->session()->forget('cart');
            return redirect()->route('index')->with('success', 'Đặt hàng thành công! Mã đơn hàng của bạn: ' . $orderCode);
        } else {
            // Chuyển hướng đến trang thanh toán online
            return redirect()->route('payment.create', ['order_id' => $order->id]);
        }
    }

    public function index()
    {
        $orders = Order::with('OrderDetail') // Load quan hệ OrderDetail
            ->orderBy('created_at', 'desc') // Sắp xếp theo ngày tạo giảm dần
            ->paginate(10); // Phân trang, mỗi trang 10 đơn hàng

        return view('admins.oder.index', compact('orders'));
    }

    public function edit(String $id)
    {
        $orders = Order::find($id);
        return view('admins.oder.edit', compact('orders'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'trang_thai_don_hang' => 'required|in:Chờ xử lý,Đang Đóng Hàng,Đang vận chuyển,Đã giao hàng,Hoàn thành,Đã hủy',
            'ghi_chu' => 'nullable|string|max:500',
        ]);

        // Lấy thông tin đơn hàng
        $order = Order::findOrFail($id);

        $currentStatus = $order->trang_thai_don_hang; // Trạng thái hiện tại
        $newStatus = $validated['trang_thai_don_hang']; // Trạng thái mới

        // Kiểm tra logic chuyển trạng thái
        if ($currentStatus === 'Chờ xử lý') {
            // Chuyển từ "Chờ xử lý" sang bất kỳ trạng thái nào khác, trừ "Chờ xử lý"
            if (!in_array($newStatus, ['Đang Đóng Hàng', 'Đang vận chuyển', 'Đã giao hàng', 'Hoàn thành', 'Đã hủy'])) {
                return redirect()->back()->with('error', "Không thể chuyển từ trạng thái \"$currentStatus\" sang \"$newStatus\".");
            }

            // Chỉ khi ở trạng thái "Chờ xử lý" mới có thể hủy
            if ($newStatus === 'Đã hủy' && $currentStatus !== 'Chờ xử lý') {
                return redirect()->back()->with('error', "Chỉ có thể hủy đơn hàng khi trạng thái là \"Chờ xử lý\".");
            }
        }
        if ($currentStatus === 'Đang Đóng Hàng') {
            if (!in_array($newStatus, ['Đang vận chuyển', 'Đã hủy'])) {
                return redirect()->back()->with('error', "Không thể chuyển từ trạng thái \"$currentStatus\" sang \"$newStatus\".");
            }
        } elseif ($currentStatus === 'Đang vận chuyển') {
            if ($newStatus !== 'Đã giao hàng') {
                return redirect()->back()->with('error', "Không thể chuyển từ trạng thái \"$currentStatus\" sang \"$newStatus\".");
            }
        } elseif ($currentStatus === 'Đã giao hàng') {
            if ($newStatus !== 'Hoàn thành') {
                return redirect()->back()->with('error', "Không thể chuyển từ trạng thái \"$currentStatus\" sang \"$newStatus\".");
            }
        } elseif (in_array($currentStatus, ['Hoàn thành', 'Đã hủy'])) {
            return redirect()->back()->with('error', "Không thể thay đổi trạng thái \"$currentStatus\".");
        } else {
            // Sau khi chuyển khỏi "Chờ xử lý", không thể quay lại "Chờ xử lý"
            if ($newStatus === 'Chờ xử lý') {
                return redirect()->back()->with('error', "Không thể quay lại trạng thái \"$newStatus\" sau khi đã chuyển đi.");
            }

            // Kiểm tra trạng thái "Hoàn thành" và cập nhật "payment_status"
            if ($newStatus === 'Hoàn thành') {
                $order->update([
                    'payment_status' => 'Đã thanh toán',
                ]);
            }elseif($newStatus=== 'Đã hủy'){
                $order->update([
                    'payment_status' => 'Đã hủy',
                ]);
            }
}

        // Nếu hợp lệ, cập nhật trạng thái và ghi chú route('admins.orders.index')
        $order->update([
            'trang_thai_don_hang' => $newStatus,
            'ghi_chu' => $validated['ghi_chu'],
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }



    public function destroy($id)
    {
        // Lấy thông tin đơn hàng
        $order = Order::findOrFail($id);

        // Kiểm tra trạng thái đơn hàng
        if (in_array($order->trang_thai_don_hang, ['Đã hủy', 'Chờ xử lý'])) {
            // Thực hiện xóa
            $order->delete();

            return redirect()->route('admins.orders.index')->with('success', 'Đơn hàng đã được xóa thành công!');
        }

        // Không được phép xóa nếu trạng thái không hợp lệ
        return redirect()->route('admins.orders.index')->with('error', 'Chỉ có thể xóa đơn hàng có trạng thái "Đã hủy" hoặc "Chờ xử lý"!');
    }
    public function updateForClient($id)
    {
        // Tìm đơn hàng
        $order = Order::findOrFail($id);

        // Kiểm tra trạng thái
        if (in_array($order->trang_thai_don_hang, ['Chờ xử lý'])) {
            // Cập nhật trạng thái đơn hàng thành "Đã hủy"
            $order->trang_thai_don_hang = 'Đã hủy';
            $order->save();


            // Thông báo thành công
            return redirect()->back()->with('success', 'Hủy đơn hàng thành công.');
        }

        // Nếu trạng thái không hợp lệ để hủy
        return redirect()->back()->with('error', 'Không thể hủy đơn hàng.');
    }

}
