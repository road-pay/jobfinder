<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - JobBoard</title>
    
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
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded-lg font-bold text-lg">J</div>
                        <span class="font-bold text-xl tracking-tight">JobBoard.</span>
                    </a>
                    <div class="hidden md:flex gap-4">
                        <a href="/dashboard" class="text-sm font-semibold text-black border-b-2 border-black py-5">Overview</a>
                        <a href="/" class="text-sm font-medium text-slate-500 hover:text-black py-5 transition">Lihat Situs</a>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="text-sm text-right hidden sm:block">
                        <p class="font-bold text-slate-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-slate-400 hover:text-red-600 transition flex items-center gap-2">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Dashboard Lowongan</h1>
                <p class="text-slate-500 mt-1">Kelola semua lowongan kerja yang telah Anda terbitkan.</p>
            </div>
            <a href="{{ route('jobs.create') }}" class="px-6 py-3 bg-black text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition shadow-lg flex items-center gap-2">
                <span class="text-lg">+</span> Pasang Lowongan Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm animate-pulse">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <p class="font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-900">Lowongan Saya ({{ $jobs->count() }})</h3>
            </div>

            <div class="divide-y divide-slate-100">
                @if($jobs->count() > 0)
                    @foreach($jobs as $job)
                        <div class="p-6 hover:bg-slate-50 transition flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="text-lg font-bold text-slate-900 hover:text-slate-600 transition">
                                        <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                                    </h4>
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold rounded uppercase tracking-wider border border-slate-200">
                                        {{ $job->job_type ?? 'Full Time' }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-wrap gap-y-2 gap-x-4 text-sm text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <span>🏢</span> {{ $job->company }}
                                    </div>
                                    <div class="flex items-center gap-1.5 text-slate-300">|</div>
                                    <div class="flex items-center gap-1.5">
                                        <span>📍</span> {{ $job->location }}
                                    </div>
                                    @if($job->salary)
                                    <div class="flex items-center gap-1.5 text-slate-900 font-semibold">
                                        <span>💰</span> Rp {{ number_format($job->salary, 0, ',', '.') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-400 mt-3 uppercase tracking-widest font-medium">
                                    Diterbitkan {{ $job->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="flex-1 md:flex-none text-center px-4 py-2 text-sm font-bold bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 hover:border-slate-400 transition">
                                    Edit
                                </a>

                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="flex-1 md:flex-none" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-center px-4 py-2 text-sm font-bold bg-white border border-red-100 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-200 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                    
                    <div class="p-6 bg-slate-50/30">
                        {{ $jobs->links() }}
                    </div>

                @else
                    <div class="text-center py-20 px-6">
                        <div class="w-16 h-16 bg-slate-100 text-slate-400 flex items-center justify-center rounded-full mx-auto mb-4 text-2xl">
                            📋
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Belum ada lowongan</h3>
                        <p class="text-slate-500 mb-8 max-w-xs mx-auto text-sm">Anda belum memposting lowongan apapun saat ini.</p>
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-black text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition shadow-lg">
                            Mulai Posting Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <footer class="py-10 text-center text-slate-400 text-xs">
        &copy; {{ date('Y') }} JobBoard Admin Panel. All rights reserved.
    </footer>

</body>
</html>