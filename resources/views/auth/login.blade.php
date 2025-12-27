<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - JobBoard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script> tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } } } } </script>
    <style>
        .bg-grid {
            background-image: linear-gradient(to right, #e2e8f0 1px, transparent 1px),
                              linear-gradient(to bottom, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased relative h-screen flex items-center justify-center overflow-hidden">
    
    <div class="absolute inset-0 bg-grid opacity-60 z-0"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent z-0"></div>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200 p-8 relative z-10">
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 group mb-4">
                <div class="w-10 h-10 bg-black text-white flex items-center justify-center rounded-lg font-bold text-xl">J</div>
                <span class="font-bold text-2xl tracking-tight text-slate-900">JobBoard.</span>
            </a>
            <h2 class="text-lg font-medium text-slate-500">Selamat datang kembali</h2>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-slate-500 hover:text-black">Lupa password?</a>
                    @endif
                </div>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition">
            </div>

            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-black shadow-sm focus:ring-black">
                <label for="remember_me" class="ml-2 block text-sm text-slate-600">Ingat saya</label>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-black text-white font-bold text-center rounded-xl hover:bg-slate-800 transition shadow-lg transform active:scale-95 duration-200">
                Masuk Akun
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-slate-500">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-black hover:underline">Daftar sekarang</a>
        </p>
    </div>
</body>
</html>