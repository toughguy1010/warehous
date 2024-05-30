<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        $data['users'] = $users;
        return view('user.index', $data);
    }
    public function upsert($id = null){
        
    }
}
