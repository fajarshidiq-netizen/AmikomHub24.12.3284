<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $categories = Category::all();
        return view('event-detail', compact('event', 'categories'));
    }
}
