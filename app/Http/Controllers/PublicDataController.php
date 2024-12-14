<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicDataController extends Controller
{
    public function user($id){
        $data['data'] = User::find($id);
        return view('public-data.user',$data);
    }
}
