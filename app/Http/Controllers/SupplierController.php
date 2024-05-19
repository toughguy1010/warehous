<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
class SupplierController extends Controller
{
    //
    public function index(){
        $suppliers = Supplier::paginate(5);
        $data['suppliers'] = $suppliers;
        return view('supplier.index', $data);
    }
    public function upsert($id = null){
        if($id !== null){
            $supplier = Supplier::findOrFail($id);
        }else{
            $supplier = null;
        }
        $data['supplier'] = $supplier;
        return view('supplier.upsert', $data);
    }
    public function upsertStore(Request $request, $id = null){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            if ($id !== null) {
                $supplier = Supplier::findOrFail($id);
            } else {
                $supplier = new Supplier();
            }
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            if ($supplier->save()) {
                session()->flash('success', $id ? 'Cập nhật thông tin nhà cung cấp thành công' : 'Thêm nhà cung cấp thành công');
                return redirect()->route('supplier.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            // Store a success message in the session
            session()->flash('success', 'Xóa nhà cung cấp thành công');
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            // Store an error message in the session
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return redirect()->route('supplier.index');
        }
    }
}
