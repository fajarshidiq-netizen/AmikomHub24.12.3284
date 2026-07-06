<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Decorative background blobs -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

    <div class="w-full max-w-md z-10">
        <!-- Logo -->
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shadow-indigo-200">
                AH
            </div>
            <span class="text-2xl font-black tracking-tight text-slate-900">AmikomEventHub</span>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50 p-10 relative overflow-hidden">
            <div class="mb-8">
                <h1 class="text-2xl font-black text-slate-950 mb-2">Selamat Datang Kembali</h1>
                <p class="text-slate-500 font-medium text-sm">Masuk untuk mengelola event dan tiket.</p>
            </div>

            <!-- Validation Messages -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl text-xs font-semibold">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Alamat Email</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@amikom.ac.id" 
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition font-semibold text-slate-800 placeholder-slate-400"
                            required autocomplete="email">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" placeholder="••••••••" 
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition font-semibold text-slate-800 placeholder-slate-400"
                            required autocomplete="current-password">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 active:translate-y-0 active:scale-98 transition-all duration-200">
                        Masuk Sekarang
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Footer text -->
        <p class="text-center text-xs text-slate-400 font-semibold mt-8">
            &copy; 2024 AmikomEventHub. Hak Cipta Dilindungi.
        </p>
    </div>
</body>
</html>
