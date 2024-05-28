<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Unit;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::paginate(5);
        $data['product'] = $products;
        return view('product.index', $data);
    }
    public function upsert($id = null){
        
        if($id !== null){
            $products = Products::findOrFail($id);
        }else{
            $products = null;
        }
        $suppliers = Supplier::all();
        $units = Unit::all();

        $data['product'] = $products;
        $data['suppliers'] = $suppliers;
        $data['units'] = $units;
        return view('product.upsert', $data);
    }
    public function upsertStore(Request $request, $id = null){
        $request->validate([
            'name' => 'required|string|max:255',

        ]);
        try {
            if ($id !== null) {
                $products = Products::findOrFail($id);
            } else {
                $products = new Products();
            }
            $products->name = $request->name;
            $products->description = $request->description;
            $products->price = $request->price;
            if ($products->save()) {
                session()->flash('success', $id ? 'Cập nhật thông tin sản phẩm thành công' : 'Thêm sản phẩm thành công');
                return redirect()->route('product.index');
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
            $products = Products::findOrFail($id);
            $products->delete();
            // Store a success message in the session
            session()->flash('success', 'Xóa khách hàng thành công');
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            // Store an error message in the session
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return redirect()->route('product.index');
        }
    }

}