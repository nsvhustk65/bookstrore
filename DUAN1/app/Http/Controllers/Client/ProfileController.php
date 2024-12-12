<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('admins.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admins.users.index')->with('success', 'User updated successfully.');
    }

    public function editPass()
    {
        $user = Auth::user();
        return view('client.layouts.partials.change-account', compact('user'));
    }

    public function updatePass(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'currentpwd' => 'required|string|min:6',
            'newpwd' => 'required|string|min:6|confirmed',  // Sử dụng xác nhận mật khẩu
        ]);

        // Lấy người dùng đã đăng nhập
        /** @var User $user */
        $user = Auth::user();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước khi thay đổi mật khẩu.');
        }

        // Kiểm tra xem mật khẩu hiện tại có khớp không
        if (!Hash::check($request->currentpwd, $user->password)) {
            return back()->withErrors(['currentpwd' => 'Mật khẩu hiện tại không đúng']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->newpwd);
        $user->save();  // Dùng save() thay vì update() để đảm bảo mật khẩu được lưu chính xác

        // Trả về view với thông báo thành công
        return redirect()->route('ShowFormMyAcc')->with('success', 'Mật khẩu đã được cập nhật thành công.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('client.layouts.partials.change-profile', compact('user'));
    }
    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('ShowFormMyAcc')->with('success', 'User updated successfully.');
    }
}
