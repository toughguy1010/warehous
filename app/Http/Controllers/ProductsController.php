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
        $products = Products::orderBy('created_at', 'desc')->paginate(5);
        $data['products'] = $products;
        return view('product.index', $data);
    }
    public function upsert($id = null)
    {

        if ($id !== null) {
            $products = Products::findOrFail($id);
        } else {
            $products = null;
        }
        $suppliers = Supplier::all();
        $units = Unit::all();

        $data['product'] = $products;
        $data['suppliers'] = $suppliers;
        $data['units'] = $units;
        return view('product.upsert', $data);
    }
    public function upsertStore(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'unit_id' => 'required|integer',
            'stock' => 'required|integer',
        ]);
        try {
            if ($id !== null) {
                $product = Products::findOrFail($id);
            } else {
                $product = new Products();
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->purchase_price = $request->purchase_price;
            $product->selling_price = $request->selling_price;
            $product->supplier_id = $request->supplier_id;
            $product->unit_id = $request->unit_id;
            $product->stock = $request->stock;
            $product->avatar = $request->avatar;
            if ($product->save()) {
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
            $product = Products::findOrFail($id);
            $product->delete();
            // Store a success message in the session
            session()->flash('success', 'Xóa sản phẩm thành công');
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            // Store an error message in the session
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return redirect()->route('product.index');
        }
    }
}
