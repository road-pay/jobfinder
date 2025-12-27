<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - JobBoard</title>
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
<body class="bg-slate-50 text-slate-900 font-sans antialiased relative min-h-screen flex items-center justify-center py-12">
    
    <div class="absolute inset-0 bg-grid opacity-60 z-0 h-full"></div>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200 p-8 relative z-10">
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 mb-4">
                <div class="w-10 h-10 bg-black text-white flex items-center justify-center rounded-lg font-bold text-xl">J</div>
            </a>
            <h2 class="text-2xl font-bold text-slate-900">Buat Akun Baru</h2>
            <p class="text-sm text-slate-500 mt-2">Mulai karir profesional Anda hari ini.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" required autofocus
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border">
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-black text-white font-bold text-center rounded-xl hover:bg-slate-800 transition shadow-lg transform active:scale-95 duration-200">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-slate-500">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-black hover:underline">Masuk disini</a>
        </p>
    </div>
</body>
</html>