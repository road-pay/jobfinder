<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - JobBoard</title>
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
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-2 mb-4">
                <div class="w-10 h-10 bg-black text-white flex items-center justify-center rounded-lg font-bold text-xl shadow-lg">?</div>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Lupa Password?</h2>
            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                Jangan khawatir. Masukkan email Anda di bawah ini dan kami akan mengirimkan link untuk mereset password Anda.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" required autofocus placeholder="nama@email.com"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-black text-white font-bold text-center rounded-xl hover:bg-slate-800 transition shadow-lg transform active:scale-95 duration-200">
                Kirim Link Reset
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-black transition">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Halaman Login
            </a>
        </div>
    </div>
</body>
</html>