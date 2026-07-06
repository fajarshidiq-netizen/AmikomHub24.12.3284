<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::with('category')->latest();

        // Search logic
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Category filter logic
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->paginate(10);
        $categories = Category::all();

        return view('admin.events.index', compact('events', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('poster');

        if ($request->hasFile('poster')) {
            // Save poster to public/posters storage disk
            $path = $request->file('poster')->store('posters', 'public');
            $data['poster_path'] = $path;
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('poster');

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $path = $request->file('poster')->store('posters', 'public');
            $data['poster_path'] = $path;
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
