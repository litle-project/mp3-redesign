<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Hash;


class ImportExcelController extends Controller
{
    public function user(Request $request){
        $data = Excel::toArray(new UserImport(), $request->file);

        $dataUsers = [];
        foreach ($data[0] as $key => $value) {
            // Skip header
            if($key > 0){
                $dataUser = [
                    'name'=>$value[1],
                    'email'=> $value[6].'@mail.com',
                    'password'=>Hash::make($value[6]),
                    'username'=>$value[6],
                    'nip'=>$value[6],
                    'status_pegawai'=>$value[10],
                ];
                User::updateOrCreate(
                    ['nip' => $value[6]],
                    $dataUser 
                );

            }
        }   
    }
}
