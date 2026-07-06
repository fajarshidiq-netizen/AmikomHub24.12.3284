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
        // Menerapkan validasi data request dari pengguna
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:1',
            'poster'      => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        if ($request->hasFile('poster')) {
            // Simpan ke direktori storage/app/public/posters
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        // Menyimpan data yang telah divalidasi ke dalam tabel menggunakan Model
        \App\Models\Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Data Event berhasil ditambahkan.');
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
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:1',
            'poster'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            // Hapus gambar lama jika sebelumnya sudah memiliki poster
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }
            // Upload gambar baru
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
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
