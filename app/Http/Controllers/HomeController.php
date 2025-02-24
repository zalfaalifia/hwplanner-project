<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        return view('home'); //menampilkan tampilan home melalui rute return view
    }
}
