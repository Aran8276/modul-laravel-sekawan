<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimpanBukuRequest;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function showView()
    {
        return view('book-form');
    }

    public function postView(SimpanBukuRequest $request)
    {
        return $request;
    }
}
