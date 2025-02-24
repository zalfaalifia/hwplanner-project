<?php

namespace App\Http\Controllers;

use App\Imports\BookImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index()
    {
        return view('books.create');
    }

}
