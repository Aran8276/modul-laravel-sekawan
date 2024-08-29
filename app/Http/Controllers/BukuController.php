<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimpanBukuRequest;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // public function showView()
    // {
    //     return view('book-form');
    // }

    // public function postView(SimpanBukuRequest $request)
    // {
    //     return $request;
    // }

    // ONLY USED FOR CUD (Create, update, delete) / POST REQUESTS ONLY. READ / GET IS DEFINED IN `PagesController`
    public function create()
    {
        // create to database
    }

    public function update()
    {
        // read parameter && update to database
    }

    public function delete()
    {
        // read parameter && delete to database
    }
}
