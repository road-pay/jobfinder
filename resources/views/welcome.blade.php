<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobBoard - Professional Career Platform</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .bg-grid {
            background-image: linear-gradient(to right, #f1f5f9 1px, transparent 1px),
                              linear-gradient(to bottom, #f1f5f9 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased selection:bg-black selection:text-white">

    <nav class="fixed w-full z-50 top-0 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded-lg font-bold text-lg group-hover:bg-slate-800 transition">J</div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">JobBoard.</span>
                </a>
                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-500 hover:text-black transition">Dashboard</a>
                        <a href="{{ route('jobs.create') }}" class="px-5 py-2.5 bg-black text-white text-sm font-semibold rounded-full hover:bg-slate-800 transition shadow-md">
                            + Pasang Lowongan
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-500 hover:text-black transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 border border-slate-200 text-slate-900 text-sm font-semibold rounded-full hover:bg-slate-50 transition">Daftar</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-grid -z-10 h-[600px] opacity-60"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm text-xs font-semibold text-slate-600 mb-8">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span>Platform Lowongan Terpercaya #1</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold tracking-tight text-slate-900 mb-6 leading-[1.1]">
                Temukan Karir <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-700 to-slate-400">Tanpa Batas.</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-500 mb-12 max-w-2xl mx-auto leading-relaxed">
                Hubungkan keahlian Anda dengan ribuan perusahaan teknologi terbaik.
            </p>
            <form action="/" method="GET" class="max-w-2xl mx-auto relative group">
                <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 p-2 shadow-xl shadow-slate-200/50">
                    <div class="pl-4 pr-2 text-slate-400">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" class="flex-1 bg-transparent border-none focus:ring-0 text-slate-800 placeholder-slate-400 h-12 text-lg" placeholder="Cari posisi (Designer, Developer)...">
                    <button type="submit" class="bg-black text-white h-12 px-8 rounded-xl text-base font-semibold hover:bg-slate-800 transition">Cari</button>
                </div>
            </form>
        </div>
    </section>

    <section class="py-20 border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Lowongan Terbaru</h2>
                    <p class="text-slate-500 mt-2 text-lg">Peluang yang baru saja diposting.</p>
                </div>
            </div>

            @if($jobs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($jobs as $job)
                        <a href="{{ route('jobs.show', $job->id) }}" class="group block p-8 bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:border-slate-200 transition-all duration-300 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-black transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-xl shadow-sm">🏢</div>
                                
                                <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">
                                    {{ $job->job_type ?? 'Full Time' }}
                                </span>

                            </div>
                            <h3 class="font-bold text-xl text-slate-900 mb-1 group-hover:text-slate-700 transition">{{ $job->title }}</h3>
                            <p class="text-base font-medium text-slate-500 mb-6">{{ $job->company }}</p>
                            <div class="grid grid-cols-2 gap-y-3 text-sm text-slate-500 border-t border-slate-50 pt-6">
                                <div class="flex items-center gap-2">📍 {{ $job->location }}</div>
                                <div class="flex items-center gap-2 justify-end">🕒 {{ $job->created_at->diffForHumans() }}</div>
                                @if($job->salary)
                                <div class="col-span-2 flex items-center gap-2 text-slate-900 font-semibold mt-1">
                                    💰 Rp {{ number_format($job->salary, 0, ',', '.') }}
                                </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-16 text-center">{{ $jobs->links() }}</div>
            @else
                <div class="text-center py-24 border border-dashed border-slate-200 rounded-3xl bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900">Belum ada lowongan</h3>
                    <a href="/" class="text-blue-600 font-medium mt-2 inline-block">Reset Pencarian</a>
                </div>
            @endif
        </div>
    </section>
</body>
</html>