<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\ExportOrder;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->query('search');
        $orders = ExportOrder::query()
            ->when($search, function ($query, $search) {
                return $query->where('order_number', 'like', '%' . $search . '%');
            })
            ->orderBy('order_date', 'desc')
            ->paginate(5)
            ->appends(['search' => $search]);
        $data['orders'] = $orders;
        $data['search'] = $search;
        return view('order.export.index', $data);
    }
    public function exportPDF($id)
    {
        $order = ExportOrder::findOrFail($id);
    
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans'); // Sử dụng font DejaVu Sans
        $options->set('isPhpEnabled', true); // Cho phép mã PHP trong blade template
        $pdf->setOptions($options);
    
        // Load HTML từ view Blade
        $html = view('order.export.pdf', compact('order'))->render();
        // Load HTML vào Dompdf
        $pdf->loadHtml($html);
    
        // Thiết lập kích thước giấy và hướng (tùy chọn)
        $pdf->setPaper('A4', 'portrait');
    
        // Render PDF
        $pdf->render();
    
        // Lấy nội dung PDF
        $output = $pdf->output();
    
        // Trả về response để tải xuống
        return Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=order_' . $order->id . '.pdf',
        ]);
    }
    public function create()
    {

        $customers = Customer::all();
        $employees = User::getEmployee();
        $products = Products::all();
        $data['customers'] = $customers;
        $data['employees'] = $employees;
        $data['products'] = $products;

        return view('order.export.upsert', $data);
    }

    public function detail($id)
    {
        $order = ExportOrder::findOrFail($id);
        $data['order'] = $order;
        return view('order.export.detail', $data);
    }

    public function store(Request $request)
    {
        try {
            $totalPrices = $request->total_price_number_export;
            $amount = array_sum($totalPrices);
            $orderNumber = 'DON_XUAT_' . $this->generateNumericString(10);
            $order = ExportOrder::create([
                'customer_id' => $request->customer_id,
                'user_id' => $request->user_id,
                'order_date' => $request->order_date,
                'order_status' => $request->status,
                'amount' => $amount,
                'order_number' => $orderNumber, // Add the order number
            ]);
            $productIds = $request->product_ids;
            $types = $request->type;
            $quantities = $request->quantity;
            $singlePrices = $request->selling_price_number;
            $orderItems = [];

            foreach ($productIds as $index => $productId) {
                $type = $types[$index];
                $quantity = $quantities[$index];

                // Check if the product is of type 'old_product' and update its stock
                if ($type === 'old_product') {
                    $product = Products::find($productId);
                    if ($product) {
                        $product->stock -= $quantity;
                        $product->save();
                    }
                }

                // Create order item
                $orderItems[] = new OrderItem([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'total_price' => $totalPrices[$index],
                    'single_price' => $singlePrices[$index],
                    'order_type' => 2,
                    'order_id' => $order->id,
                ]);
            }
            $order->items()->saveMany($orderItems);
            session()->flash('success', 'Tạo đơn hàng xuất thành công');
            return redirect()->route('export.index');
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

    public function delete($id)
    {
        try {
            // Find the order by its ID along with its associated order items
            $order = ExportOrder::with('items')->findOrFail($id);

            // Delete the order items
            $order->items()->delete();

            // Delete the order
            $order->delete();

            return redirect()->route('export.index')->with('success', 'Xóa đơn hàng thành công.');
        } catch (\Exception $e) {
            return redirect()->route('export.index')->with('error', 'Có lỗi trong xử lí đơn hàng: ' . $e->getMessage());
        }
    }

    public function changeStatus(Request $request, $id)
    {
        // Find the order by ID
        $order = ExportOrder::findOrFail($id);

        // Update the order status
        $order->order_status = $request->input('order_status');
        $order->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thay đổi trạng thái đơn hàng thành công!');
    }
}
