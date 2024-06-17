<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->query('search');
        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(5)
            ->appends(['search' => $search]);
        $data['customers'] = $customers;
        $data['search'] = $search;
        return view('customer.index', $data);
    }
    public function upsert($id = null)
    {
        if ($id !== null) {
            $customer = Customer::findOrFail($id);
        } else {
            $customer = null;
        }
        $data['customer'] = $customer;
        return view('customer.upsert', $data);
    }
    public function upsertStore(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            if ($id !== null) {
                $customer = Customer::findOrFail($id);
            } else {
                $customer = new Customer();
            }
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            if ($customer->save()) {
                session()->flash('success', $id ? 'Cập nhật thông tin khách hàng thành công' : 'Thêm khách hàng thành công');
                return redirect()->route('customer.index');
            }
        } catch (\Exception $e) {
            dd($e);
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            // Store a success message in the session
            session()->flash('success', 'Xóa khách hàng thành công');
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            // Store an error message in the session
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return redirect()->route('customer.index');
        }
    }
}
