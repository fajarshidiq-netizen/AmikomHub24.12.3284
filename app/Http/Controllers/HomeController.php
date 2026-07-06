<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        
        $query = \App\Models\Event::with('category');
        
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $events = $query->latest()->get();
        
        return view('welcome', compact('categories', 'events'));
    }
}
