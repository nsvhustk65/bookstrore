<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function ShowFormForpassWork()
    {
        return view('client.layouts.partials.forgot-password');
    }
    public function sendResetLinkEmail(Request $req)
    {

        $req->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Bạn không được để trống!',
            'email.email' => 'Vui lòng nhập đúng định dạng email!',
            'email.exists' => "Email không khớp!",
        ]);

        $email = $req->email;
        Mail::send('client.layouts.partials.resets', ['email' => $email], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Yêu cầu đặt lại mật khẩu mới');
        });

        return redirect()->route('index')->with('status', 'Đã gửi email tới tài khoản của bạn');
    }

    public function ShowFormResetPasswoek()
    {
        return view('client.layouts.partials.resetpasswork');
    }

    public function passwordupdate(request $req)
    {

        $req->validate([
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|email'
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'email.required' =>'email Không Được Bỏ Trống !',
            'email.email' => 'Bạn Không Nhập Đúng Email!'

        ]);
        // tìm người dùng dựa trên email
        $user = User::where('email', $req->email)->first();
        // chech người dùng
        if (!$user) {
            return redirect()->back()->with('secsse', 'không có người dungg này!');
        }
        // cập nhật người dùng
        $user->password = hash::make($req->password);
        $user->save();
        return redirect()->route('login')->with('secs', 'cập nhật mật khẩu thành công!');
    }

}
