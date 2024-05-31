<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportOrder;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Products;
class ImportOrderController extends Controller
{
    //
    public function create($id = null){
        
        $suppilers = Supplier::all();
        $employees = User::getEmployee();
        $products = Products::all();
        $data['suppilers'] = $suppilers;
        $data['employees'] = $employees;
        $data['products'] = $products;

        return view('order.import.upsert', $data);
    }
}
