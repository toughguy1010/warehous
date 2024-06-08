<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportOrder;
use App\Models\OrderItem;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Products;

class ImportOrderController extends Controller
{
    //
    public function index(){
        $orders = ImportOrder::paginate (5);
        $data['orders'] = $orders;
        return view('order.import.index',$data);
    }
    public function create($id = null)
    {

        $suppilers = Supplier::all();
        $employees = User::getEmployee();
        $products = Products::all();
        $data['suppilers'] = $suppilers;
        $data['employees'] = $employees;
        $data['products'] = $products;

        return view('order.import.upsert', $data);
    }
    public function store(Request $request)
    {
        try {
            $totalPrices = $request->total_price;
            $amount = array_sum($totalPrices);
            $orderNumber = 'WAREHOUSE_IMPORT_' . $this->generateNumericString(10);
            $order = ImportOrder::create([
                'supplier_id' => $request->supplier_id,
                'user_id' => $request->user_id,
                'order_date' => $request->order_date,
                'order_status' => $request->status,
                'amount' => $amount,
                'order_number' => $orderNumber, // Add the order number
            ]);
            $productIds = $request->product_ids;
            $types = $request->type;
            $quantities = $request->quantity;
            $singlePrices = $request->purchase_price_number;
            $orderItems = [];

            foreach ($productIds as $index => $productId) {
                $type = $types[$index];
                $quantity = $quantities[$index];

                // Check if the product is of type 'old_product' and update its stock
                if ($type === 'old_product') {
                    $product = Products::find($productId);
                    if ($product) {
                        $product->stock += $quantity;
                        $product->save();
                    }
                }

                // Create order item
                $orderItems[] = new OrderItem([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'total_price' => $totalPrices[$index],
                    'single_price' => $singlePrices[$index],
                    'order_type' => 1,
                    'order_id' => $order->id,
                ]);
            }
            $order->items()->saveMany($orderItems);
            session()->flash('success','Tạo đơn hàng nhập thành công');
            // return redirect()->route('product.index');
            return back();
        } catch (\Exception $e) {
            dd($e);
            session()->flash('error', 'Có lỗi trong quá trình xử lí thông tin');
            return back();
        }
    }

    private function generateNumericString($length)
    {
        $numbers = '0123456789';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        return $result;
    }
}
