<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Products;
use App\Models\ImportOrder;
use App\Models\ExportOrder;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $total_product = Products::count();
        $total_import = ImportOrder::count();
        $total_export = ExportOrder::count();

        // Get total stock quantity
        $totalStock = Products::sum('stock');

        // Get each product's stock quantity
        $products = Products::select('*')->get();

        $filter = $request->input('filter', 'month'); // default filter is month
        $date = Carbon::now();
        switch ($filter) {
            case 'month':
                $startDate = $date->startOfMonth()->format('Y-m-d');
                $endDate = $date->endOfMonth()->format('Y-m-d');
                break;
            case 'year':
                $startDate = $date->startOfYear()->format('Y-m-d');
                $endDate = $date->endOfYear()->format('Y-m-d');
                break;
            default:
                $startDate = $date->startOfMonth()->format('Y-m-d');
                $endDate = $date->endOfMonth()->format('Y-m-d');
                break;
        }

        if ($filter >= 1 && $filter <= 12) {
            $startDate = $date->setMonth($filter)->startOfMonth()->format('Y-m-d');
            $endDate = $date->setMonth($filter)->endOfMonth()->format('Y-m-d');
        }


        // Get revenue for ImportOrders within the specified date range
        $importRevenue = ImportOrder::selectRaw('DATE(order_date) as date, SUM(amount) as total')
            ->where('order_status', 1)
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $totalImportRevenue = $importRevenue->sum('total');
        // Get revenue for ExportOrders within the specified date range
        $exportRevenue = ExportOrder::selectRaw('DATE(order_date) as date, SUM(amount) as total')
            ->where('order_status', 1)
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $totalExportRevenue = $exportRevenue->sum('total');

        $data = [
            'total_product' => $total_product,
            'total_import' => $total_import,
            'total_export' => $total_export,
            'importRevenue' => $importRevenue,
            'exportRevenue' => $exportRevenue,
            'totalImportRevenue' => $totalImportRevenue,
            'totalExportRevenue' => $totalExportRevenue,
            'filter' => $filter,
            'date' => $date,
            'totalStock' => $totalStock,
            'products' => $products,
        ];

        return view('home', $data);
    }
    public function admin()
    {
        return 'admin';
    }
}
