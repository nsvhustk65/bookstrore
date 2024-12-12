<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\QrImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminQrController extends Controller
{
    public function showlist()
    {
        $listanh = QrImage::get();
        return view('admins.QR.index', compact('listanh'));
    }
    public function formedit($id)
    {
        $qrImage = QrImage::findOrFail($id);
        return view('admins.QR.edit', compact('qrImage'));
    }
    public function them()
    {
        return view('admins.QR.add');
    }
    public function updateStatus(Request $request, $id)
    {
        // Tìm ảnh theo ID
        $qrImage = QrImage::findOrFail($id);

        // Cập nhật trạng thái từ form (1: hiển thị, 0: ẩn)
        $qrImage->status = $request->input('status');
        $qrImage->save();

        // Chuyển hướng lại với thông báo thành công
        return redirect()->route('admins.anh.index')->with('success', 'Trạng thái của ảnh đã được cập nhật!');
    }


    public function store(request $request)
    {
        $validate = $request->validate([
            'qr_code' => 'required|file'
        ], [
            'qr_code.required' => ' Không có file ảnh!',
            'qr_code.file' => ' Không Đúng định dạng file',

        ]);
        try {
            if ($request->hasFile('qr_code')) {
                $validate['qr_code'] = $request->file('qr_code')->store('qr_images', 'public');
                $validate['qr_code'] = Storage::put('qr_images', $request->file('qr_code'));
                QrImage::query()->create($validate);
                return redirect()
                    ->route('admins.anh.index')
                    ->with('success', 'thêm ảnh thành công!');
            }
        } catch (\Throwable $th) {
            return view('admins.QR.index');
        }
    }
    public function showTest($order_id)
    {
        // $orderId = Order::findOrFail($orderId);
        $visibleQrImages = QrImage::visible()->get();
        // Truy vấn lấy đơn hàng theo ID và người dùng đăng nhập
        $order = Order::where('id', $order_id)
            ->where('user_id', Auth::id()) // Đảm bảo người dùng hiện tại sở hữu đơn hàng
            ->with('OrderDetail.product') // Bao gồm quan hệ chi tiết sản phẩm
            ->first(); // Lấy kết quả đầu tiên hoặc null nếu không tồn tại

        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$order) {
            return redirect()->route('client.layouts.partials.paymentQR')->with('error', 'Đơn hàng không tồn tại hoặc bạn không có quyền truy cập.');
        }
        // dd( $order);
        return view('client.layouts.partials.paymentQR', compact('visibleQrImages', 'order'));
    }
    // hủy đơn hagf trong thanh toán trang qr
    public function cancelOrder($orderId)
    {
        $oder = Order::where('id', $orderId)
            ->where('user_id', Auth::id()) // đảm bảo chỉ lấy người dùng hiện tại khi đăng nhập
            ->first();
        // kiểm tra tìm thông tin đơn hàng
        if (!$oder) {
            return redirect()->route('client.layouts.partials.paymentQR')->with('error', 'đơn hàng không tồn tại!');
        }
        // cập nhật trangj thái thành công
        $oder->trang_thai_don_hang = 'Đã hủy';
        $oder->save();
        return redirect()->route('index')->with('sussece', 'hủy đơn hàng thành công!');
    }

    
    public function confirmPayment($orderId , Request $request)
    {
        // Tìm đơn hàng theo ID và người dùng hiện tại
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id()) // Đảm bảo chỉ cập nhật đơn hàng của người dùng hiện tại
            ->first();

        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$order) {
            return redirect()->route('client.layouts.partials.paymentQR')->with('error', 'Đơn hàng không tồn tại hoặc bạn không có quyền truy cập.');
        }

        // Cập nhật trạng thái đơn hàng thành 'Đang xử lý'
        $order->trang_thai_don_hang = 'Chờ xử lý'; // Hoặc trạng thái tương ứng trong hệ thống của bạn
        $order->save();
         // Xóa giỏ hàng khỏi session
        $request->session()->forget('cart');


        return redirect()->route('index')->with('success', 'Thanh toán thành công, đơn hàng đang được xử lý.');
    }

}
