<?php

namespace App\Http\Controllers\pa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use Stripe\Checkout\Session;


class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request , $order_id)
    {
        // Lấy đơn hàng từ bảng orders (dùng order_id trong Request)
        $order = Order::findOrFail($order_id);
        // dd($order);

        // Kiểm tra xem đơn hàng có hợp lệ không
        if (!$order) {
            return response()->json(['error' => 'Không tìm thấy đơn hàng'], 404);
        }

        // Đặt key của Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Tạo Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],  // Các phương thức thanh toán mà bạn muốn chấp nhận
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'VND',  // Tiền tệ của bạn
                            'product_data' => [
                                'name' => 'Đơn hàng ' . $order->id ,

                            ],
                            'unit_amount' => $order->tong_tien   , // Số tiền tính bằng cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',  // Chế độ thanh toán
                'success_url' => route('payment.success', ['orderId' => $order->id]),  // URL khi thanh toán thành công
                'cancel_url' => route('payment.cancel', ['orderId' => $order->id]),   // URL khi thanh toán bị hủy
            ]);

            // Trả về URL của checkout session cho người dùng
            return redirect($session->url);  // Chuyển hướng người dùng đến trang thanh toán

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function paymentSuccess($orderId ,request $request)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($orderId);

        // Cập nhật trạng thái thanh toán
        $order->update([
            'payment_status' => 'Đã thanh toán',
        ]);
        $request->session()->forget('cart');

     
        return view('client.layouts.partials.paymentsuccess', ['order' => $order]);
    }


    public function paymentCancel($orderId)
    {
        // Xử lý khi thanh toán bị hủy
        $order = Order::find($orderId);
        if ($order) {

            $order->orderDetail()->delete();

            $order->delete();
        }

        return view('client.layouts.partials.paymentcancel', ['order' => $order]);
    }
}

// test thanh toán

// 1. Thẻ cơ bản để thanh toán thành công
// Số thẻ: 4242 4242 4242 4242
// Ngày hết hạn: Bất kỳ (ví dụ: 12/34)
// CVC: Bất kỳ (ví dụ: 123)
// Mô tả: Thanh toán sẽ luôn thành công.
// 2. Thẻ quốc tế
// Stripe hỗ trợ thử nghiệm các loại thẻ từ nhiều quốc gia:

// Thẻ Visa quốc tế: 4000 0082 6000 0000 (Không yêu cầu xác minh 3D Secure).
// Thẻ có xác minh 3D Secure: 4000 0000 0000 3220 (Yêu cầu xác minh 3D Secure).
// 3. Thẻ lỗi thanh toán
// Từ chối thanh toán: 4000 0000 0000 9995 (Thanh toán bị từ chối).
// Không đủ tiền: 4000 0000 0000 0341 (Thẻ không có đủ số dư để thanh toán).
// Lỗi mã CVC: 4000 0000 0000 0101 (Lỗi mã xác minh CVC).
// Lỗi hết hạn: 4000 0000 0000 0069 (Thẻ hết hạn).
// Lỗi thẻ bị khóa: 4000 0000 0000 0119.
// 4. Thanh toán nhiều tiền tệ
// Stripe hỗ trợ kiểm tra nhiều loại tiền tệ. Một số ví dụ:

// Thẻ Euro: 4000 0000 0000 3055 (EUR - thanh toán thành công).
// Thẻ Pound: 4000 0000 0000 3188 (GBP - thanh toán thành công).
// 5. Thanh toán bằng thẻ giả mạo (fraudulent)
// Thẻ bị gắn cờ: 4100 0000 0000 0019 (Mô phỏng giao dịch gian lận).
// 6. Thẻ khác
// Thẻ JCB: 3566 1111 1111 1113
// Thẻ American Express (AMEX): 3782 8224 6310 005
// 7. Lỗi hệ thống thanh toán
// Lỗi mạng: 4000 0000 0000 0127 (Mô phỏng lỗi khi xử lý thanh toán).
// Hướng dẫn sử dụng
// Số thẻ: Chọn một trong các thẻ trên.
// Ngày hết hạn: Nhập bất kỳ ngày nào trong tương lai (ví dụ: 12/34).
// CVC: Nhập bất kỳ 3 chữ số nào (ví dụ: 123).
