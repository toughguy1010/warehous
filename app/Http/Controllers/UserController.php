<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['search' => $search]);
        $data['users'] = $users;
        $data['search'] = $search;

        return view('user.index', $data);
    }
    public function upsert($id = null)
    {
        if ($id !== null) {
            $user = User::findOrFail($id);
        } else {
            $user = null;
        }
        $data['user'] = $user;
        return view("user.upsert", $data);
    }
    public function upsertStore(Request $request, $id = null)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . ($id ?? 'NULL') . ',id',
                'phone' => 'nullable|string|unique:users,phone,' . ($id ?? 'NULL') . ',id',
                'password' => $id ? 'nullable' : 'required|string|min:8',
                'status' => 'required|integer|in:0,1',
                'type' => 'required|string|in:admin,employee',
            ];
            $messages = [
                'name.required' => 'Tên người dùng là bắt buộc.',
                'name.string' => 'Tên người dùng phải là một chuỗi ký tự.',
                'name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
                'email.unique' => 'Email này đã được sử dụng.',
                'phone.string' => 'Số điện thoại phải là một chuỗi ký tự.',
                'phone.unique' => 'Số điện thoại này đã được sử dụng.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'status.required' => 'Xin vui lòng chọn trạng thái hoạt động.',
                'type.required' => 'Xin vui lòng chọn chức vụ.',

            ];

            $request->validate($rules, $messages);
            if ($id !== null) {
                $user = User::findOrFail($id);
            } else {
                $user = new User();
            }


            // Assign values
            $user->name = $request['name'];
            $user->email = $request->email;
            $user->phone = $request->phone ?? $user->phone;
            $user->address = $request->address;
            $user->status = $request->status;
            $user->type = $request->type;
            $user->avatar = $request->avatar;
            // Handle password
            if (!$id) {
                $user->password = bcrypt($request->password);
            }
            if ($user->save()) {
                session()->flash('success', $id ? 'Cập nhật thông tin tài khoản thành công' : 'Thêm tài khoản thành công');
                return redirect()->route('user.index');
            }
        } catch (\Exception $e) {
            // Flash error message to the session
            session()->flash('error', $e->getMessage());

            // Redirect back with input
            return redirect()->back()->withInput();
        }
    }
    public function updateProfile(Request $request, $id = null)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . ($id ?? 'NULL') . ',id',
                'phone' => 'nullable|string|unique:users,phone,' . ($id ?? 'NULL') . ',id',
                'password' => $id ? 'nullable' : 'required|string|min:8',
                'status' => 'required|integer|in:0,1',
                'type' => 'required|string|in:admin,employee',
            ];
            $messages = [
                'name.required' => 'Tên người dùng là bắt buộc.',
                'name.string' => 'Tên người dùng phải là một chuỗi ký tự.',
                'name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
                'email.unique' => 'Email này đã được sử dụng.',
                'phone.string' => 'Số điện thoại phải là một chuỗi ký tự.',
                'phone.unique' => 'Số điện thoại này đã được sử dụng.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'status.required' => 'Xin vui lòng chọn trạng thái hoạt động.',
                'type.required' => 'Xin vui lòng chọn chức vụ.',

            ];

            $request->validate($rules, $messages);
            if ($id !== null) {
                $user = User::findOrFail($id);
            } else {
                $user = new User();
            }


            // Assign values
            $user->name = $request['name'];
            $user->email = $request->email;
            $user->phone = $request->phone ?? $user->phone;
            $user->address = $request->address;
            $user->status = $request->status;
            $user->type = $request->type;
            $user->avatar = $request->avatar;
            // Handle password
            if (!$id) {
                $user->password = bcrypt($request->password);
            }
            if ($user->save()) {
                session()->flash('success', $id ? 'Cập nhật thông tin tài khoản thành công' : 'Thêm tài khoản thành công');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Flash error message to the session
            session()->flash('error', $e->getMessage());

            // Redirect back with input
            return redirect()->back()->withInput();
        }
    }
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}
