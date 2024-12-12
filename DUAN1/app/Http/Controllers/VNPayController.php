<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class VNPayController extends Controller
{
    public function createPayment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "M9RT5COB"; // Mã website
        $vnp_HashSecret = "R1JT07YWYFESI4MVUHFAZ3KH0X1OVUUQ"; // Chuỗi bí mật

        $vnp_TxnRef = '1';
        $vnp_OrderInfo = "Thanh toán đơn hàng sách kỹ năng mềm";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = 50000000 * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "VNPAYQR";
        $vnp_IpAddr = "127.0.0.1"; // Địa chỉ IP thực tế

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $hashdata = http_build_query($inputData, '', '&');
        $query = http_build_query($inputData, '', '&');

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;


        return redirect()->away($vnp_Url);
    }



    public function returnPayment(Request $request)
{
    $vnp_HashSecret = env('VNP_HASH_SECRET');
    $inputData = $request->all();
    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash']);
    unset($inputData['vnp_SecureHashType']);

    // Sắp xếp lại các tham số và tạo chuỗi hash
    ksort($inputData);
    $hashData = urldecode(http_build_query($inputData));
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    // Kiểm tra checksum
    if ($secureHash === $vnp_SecureHash) {
        if ($inputData['vnp_ResponseCode'] == '00') {
            // Xử lý cập nhật trạng thái đơn hàng thành công
            $order = Order::find($inputData['vnp_TxnRef']);
            if ($order) {
                $order->status = 'Đang Đóng Hàng';
                $order->payment_date = now();
                $order->save();
            }
            return redirect()->route('home')->with('success', 'Thanh toán thành công!');
        }
    }

    return redirect()->route('home')->with('error', 'Thanh toán thất bại!');
}

}

