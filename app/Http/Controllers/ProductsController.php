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
    public function upsert(Request $request, $id = null)
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
        if ($request->ajax()) {
            return view('order.import.modal', $data);
        }
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
                if ($request->ajax()) {
                    $total = $product->purchase_price * $product->stock;
                    return response()->json([
                        'success' => true,
                        'message' => 'Thêm hàng hóa thành công',
                        'id' => $product->id,
                        'name' => $product->name,
                        'avatar' => showImage($product->avatar), // Điều chỉnh đường dẫn ảnh
                        'stock' => $product->stock, // Cộng thêm stock nếu có
                        'purchase_price' => showPrice($product->purchase_price),
                        'purchase_price_number' => $product->purchase_price, // Cộng thêm stock nếu có
                        'total_price_number' => $total,
                        'total' => showPrice($total),
                    ]);
                }
                session()->flash('success', $id ? 'Cập nhật thông tin hàng hóa thành công' : 'Thêm hàng hóa thành công');
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
            session()->flash('success', 'Xóa hàng hóa thành công');
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            // Store an error message in the session
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return redirect()->route('product.index');
        }
    }
    public function getProductDetail(Request $request, $id)
    {
        $product = Products::find($id);

        if ($product) {
            // Kiểm tra xem có truyền thêm 'stock' không
            $additional_stock = $request->input('stock', 0);
            if($request->type == 'export' && $additional_stock > $product->stock){
                return response()->json([
                    'message' => 'Số lượng sản phẩm không đủ so với số lượng đã nhập',
                    'success' => false,
                ]);

            }
           
            $stock =  $additional_stock;
            $total = $product->purchase_price * $stock;
            $total_export = $product->selling_price * $stock;
            $response = [
                'id' => $product->id,
                'name' => $product->name,
                'avatar' => showImage($product->avatar), // Điều chỉnh đường dẫn ảnh
                'stock' => $stock, // Cộng thêm stock nếu có
                'purchase_price_number' => $product->purchase_price, // Cộng thêm stock nếu có
                'purchase_price' => showPrice($product->purchase_price),
                'selling_price_number' => $product->selling_price, // Cộng thêm stock nếu có
                'selling_price' => showPrice($product->selling_price),
                'total_price_number' => $total,
                'total' => showPrice($total),
                'total_export' => showPrice($total_export),
                'total_price_number_export' => $total_export,
            ];

            return response()->json($response);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
