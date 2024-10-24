<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('index' ,[
            'books' => Book::latest()->paginate(10)
        ]);
    }
}
