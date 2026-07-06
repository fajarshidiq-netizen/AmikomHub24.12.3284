<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.events');
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function edit($id)
    {
        return view('admin.events.edit');
    }
}
