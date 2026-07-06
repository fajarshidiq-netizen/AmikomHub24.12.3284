@extends('layouts.admin')

@section('title', 'Tambah Event Baru')

@section('content')
        <div class="mb-10">
            <a href="{{ route('admin.events.index') }}" class="text-indigo-600 font-bold flex items-center gap-2 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Event
            </a>
            <h1 class="text-3xl font-black">Tambah Event Baru</h1>
            <p class="text-slate-500 font-medium">Buat acara baru dan mulailah menjual tiket.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 max-w-3xl">
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Event</label>
                        <input type="text" placeholder="Masukkan nama event"
                            class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori</label>
                        <select class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium">
                            <option>Musik</option>
                            <option>Workshop</option>
                            <option>Coding</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Harga Tiket (Rp)</label>
                        <input type="number" placeholder="Contoh: 150000"
                            class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Stok Tiket</label>
                        <input type="number" placeholder="Contoh: 100"
                            class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium"
                            required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi Event</label>
                    <textarea placeholder="Jelaskan detail event Anda..." rows="5"
                        class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium"
                        required></textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all">
                        Simpan Event
                    </button>
                    <a href="{{ route('admin.events.index') }}"
                        class="px-8 py-4 border border-slate-200 rounded-2xl font-bold text-lg hover:bg-slate-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
@endsection
