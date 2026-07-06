<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AmikomHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgba(243, 244, 246, 1) 0%, rgba(224, 231, 255, 0.3) 90%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        @keyframes pulse-slow {
            0%, 100% { transform: scale(1) translate(0px, 0px); opacity: 0.3; }
            50% { transform: scale(1.05) translate(10px, -10px); opacity: 0.4; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 8s infinite ease-in-out;
        }
    </style>
</head>

<body class="text-slate-900 min-h-screen relative overflow-x-hidden antialiased">

    <!-- Background Decorative Blobs -->
    <div class="absolute top-[-10%] right-[-10%] w-[50vw] h-[50vw] rounded-full bg-indigo-200/40 filter blur-[120px] pointer-events-none animate-pulse-slow"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[40vw] h-[40vw] rounded-full bg-violet-200/30 filter blur-[100px] pointer-events-none animate-pulse-slow" style="animation-delay: 3s;"></div>

    <main class="max-w-6xl mx-auto px-6 py-12 md:py-20 relative z-10">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 font-bold flex items-center gap-2 mb-4 hover:text-indigo-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Detail Event
                </a>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">Konfirmasi Pemesanan</h1>
                <p class="text-slate-500 mt-1">Satu langkah lagi untuk mengamankan tiket Anda.</p>
            </div>
            <div class="flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-2xl font-bold text-xs uppercase tracking-wide">
                <span class="w-2 h-2 rounded-full bg-indigo-600 animate-ping"></span>
                Sesi Checkout Aktif
            </div>
        </div>

        @if(session('error'))
            <div class="mb-8 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl font-medium flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-5 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl">
                <div class="flex items-center gap-3 mb-2 text-rose-800 font-bold">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Terjadi kesalahan validasi:</span>
                </div>
                <ul class="list-disc list-inside text-sm font-medium space-y-1 pl-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Side: Form Data Pemesan -->
            <div class="lg:col-span-7 bg-white/80 glass-card rounded-[2.5rem] border border-slate-200/60 p-8 shadow-xl shadow-slate-100">
                <div class="mb-8">
                    <span class="text-xs font-black uppercase text-indigo-600 tracking-widest bg-indigo-50 px-3.5 py-1.5 rounded-xl">Langkah 1 dari 1</span>
                    <h3 class="text-2xl font-black mt-3">📋 Data Diri Pemesan</h3>
                    <p class="text-slate-500 text-sm mt-1">E-Ticket akan dikirimkan langsung ke alamat email yang Anda daftarkan.</p>
                </div>

                <form action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-xs font-black text-slate-700 mb-2.5 uppercase tracking-wider">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Masukkan nama sesuai KTP / Identitas"
                                class="w-full pl-12 pr-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition font-semibold"
                                required>
                        </div>
                    </div>

                    <!-- Email & No. WhatsApp -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-700 mb-2.5 uppercase tracking-wider">Email Aktif</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="contoh@gmail.com"
                                    class="w-full pl-12 pr-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition font-semibold"
                                    required>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-wide flex items-center gap-1">
                                <span class="inline-block w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                Cek berkala folder spam email Anda
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-700 mb-2.5 uppercase tracking-wider">No. WhatsApp</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </span>
                                <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="08xxxxxxxxxx"
                                    class="w-full pl-12 pr-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition font-semibold"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white rounded-2xl font-black text-lg shadow-xl shadow-indigo-100 hover:shadow-2xl hover:shadow-indigo-200 active:scale-[0.98] transition-all duration-300">
                            Bayar Sekarang
                        </button>
                        <div class="mt-4 flex items-center justify-center gap-2 text-xs text-slate-400 font-bold uppercase tracking-wider">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Koneksi Pembayaran Aman & Terenkripsi
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Side: Event Details & Summary -->
            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-32">
                
                <!-- Ticket Card -->
                <div class="bg-white/90 glass-card rounded-[2.5rem] border border-slate-200/60 overflow-hidden shadow-xl shadow-slate-100">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        @php
                            $posterUrl = $event->poster_path
                                ? \Illuminate\Support\Facades\Storage::url($event->poster_path)
                                : asset('assets/concert.png');
                        @endphp
                        <img src="{{ $posterUrl }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-xl text-[10px] font-black uppercase tracking-widest border border-white/10">
                                {{ $event->category->name }}
                            </span>
                            <h4 class="font-extrabold text-xl mt-2 line-clamp-1 text-white">{{ $event->title }}</h4>
                        </div>
                    </div>

                    <!-- Details Info -->
                    <div class="p-8 space-y-5">
                        <div class="flex items-center gap-3 text-slate-600">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Tanggal & Waktu</p>
                                <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-slate-600">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider">Tempat / Lokasi</p>
                                <p class="text-sm font-bold text-slate-800 line-clamp-1">{{ $event->location }}</p>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="pt-6 border-t border-slate-100 space-y-3.5">
                            <h5 class="font-black text-sm text-slate-800">Rincian Pembayaran</h5>
                            <div class="flex justify-between text-sm text-slate-500 font-medium">
                                <span>1x Tiket Acara</span>
                                <span class="font-bold text-slate-800">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-slate-500 font-medium">
                                <span>Biaya Layanan (Admin)</span>
                                <span class="font-bold text-slate-800">Rp 5.000</span>
                            </div>
                            <div class="flex justify-between items-center text-slate-900 pt-4 border-t border-dashed border-slate-200">
                                <span class="font-extrabold text-base">Total Pembayaran</span>
                                <span class="text-2xl font-black text-indigo-600">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>

</html>
