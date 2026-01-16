<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testcontroller extends Controller
{
    public function show(){
        return response()->json(["message" => 'hello world']);
    }
}
