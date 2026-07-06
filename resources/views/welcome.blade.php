@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1
                Event Platform</span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                    Mulai Jelajah
                </a>
                <a href="#"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="{{ asset('assets/concert.png') }}" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                        <p class="font-bold">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12 border-b border-slate-100 pb-8">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-slate-900 mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
            <div class="flex flex-wrap gap-2.5">
                <a href="{{ route('home') }}#events"
                    class="px-5 py-3 rounded-2xl border text-sm font-bold transition-all duration-300 {{ !request('category') ? 'bg-indigo-600 text-white border-indigo-600 shadow-xl shadow-indigo-100' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $category)
                    @php
                        $isActive = request('category') == $category->slug;
                    @endphp
                    <a href="{{ route('home', ['category' => $category->slug]) }}#events"
                        class="px-5 py-3 rounded-2xl border text-sm font-bold transition-all duration-300 {{ $isActive ? 'bg-indigo-600 text-white border-indigo-600 shadow-xl shadow-indigo-100' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
                @php
                    // Fallback poster logic
                    $posterUrl = asset('assets/concert.png');
                    if ($event->poster_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($event->poster_path)) {
                        $posterUrl = \Illuminate\Support\Facades\Storage::url($event->poster_path);
                    } else {
                        if ($event->category->slug == 'it-coding') {
                            $posterUrl = asset('assets/hackathon.png');
                        } elseif ($event->category->slug == 'design-creative') {
                            $posterUrl = asset('assets/workshop.png');
                        } elseif ($event->category->slug == 'e-sports-gaming') {
                            $posterUrl = asset('assets/concert.png');
                        }
                    }

                    // Badge colors based on category
                    $catBadgeColor = 'bg-indigo-500/90';
                    if ($event->category->slug == 'it-coding') {
                        $catBadgeColor = 'bg-emerald-600/90';
                    } elseif ($event->category->slug == 'design-creative') {
                        $catBadgeColor = 'bg-amber-600/90';
                    } elseif ($event->category->slug == 'e-sports-gaming') {
                        $catBadgeColor = 'bg-purple-600/90';
                    }
                @endphp
                
                <div class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="relative overflow-hidden aspect-[4/3] rounded-t-[2rem]">
                            <img src="{{ $posterUrl }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4 px-3.5 py-1.5 {{ $catBadgeColor }} backdrop-blur text-white rounded-xl text-xs font-extrabold uppercase tracking-wider shadow-sm">
                                {{ $event->category->name }}
                            </div>

                            <!-- Stock Status Badge -->
                            <div class="absolute bottom-4 right-4 backdrop-blur shadow-sm">
                                @if($event->stock == 0)
                                    <span class="px-3 py-1.5 bg-rose-600 text-white rounded-xl text-[10px] font-black uppercase tracking-wider">Sold Out</span>
                                @elseif($event->stock <= 30)
                                    <span class="px-3 py-1.5 bg-amber-500 text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-wider">Stok Tipis ({{ $event->stock }})</span>
                                @else
                                    <span class="px-3 py-1.5 bg-emerald-500 text-white rounded-xl text-[10px] font-black uppercase tracking-wider">Tersedia</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 text-slate-950 group-hover:text-indigo-600 transition min-h-[56px] line-clamp-2 leading-snug">
                                {{ $event->title }}
                            </h3>
                            <div class="space-y-2.5">
                                <div class="flex items-center gap-2.5 text-slate-500 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y, H:i') }} WIB</span>
                                </div>
                                <div class="flex items-center gap-2.5 text-slate-500 text-sm">
                                    <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium line-clamp-1">{{ $event->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 pt-0">
                        <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                            <div class="flex flex-col">
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Harga Tiket</span>
                                <span class="text-xl font-black text-slate-900">
                                    @if($event->price == 0)
                                        Gratis
                                    @else
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}"
                                class="px-6 py-3 bg-indigo-50 text-indigo-600 rounded-2xl font-bold hover:bg-indigo-600 hover:text-white hover:shadow-lg hover:shadow-indigo-100 active:scale-95 transition-all duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-[2rem] border border-slate-100">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-400 font-bold text-lg">Tidak ada event pada kategori ini saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
