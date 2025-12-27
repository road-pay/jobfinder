<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }} di {{ $job->company }} - JobBoard</title>
    
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
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded-lg font-bold text-lg group-hover:bg-slate-800 transition">J</div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">JobBoard.</span>
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="/" class="text-sm font-medium text-slate-500 hover:text-black transition">Cari Lowongan Lain</a>
                    @auth
                        <a href="/dashboard" class="text-sm font-medium text-slate-900">Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-slate-200 pb-12 pt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700 uppercase tracking-wide">
                        {{ $job->job_type }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $job->location }}
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 tracking-tight mb-4">{{ $job->title }}</h1>
                
                <div class="flex items-center gap-3 text-lg text-slate-500 font-medium">
                    <span class="flex items-center gap-2">
                        <span class="bg-slate-100 p-1.5 rounded-md text-slate-900">🏢</span> 
                        {{ $job->company }}
                    </span>
                    <span class="text-slate-300">•</span>
                    <span>Diposting {{ $job->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                <div class="prose prose-slate max-w-none">
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Deskripsi Pekerjaan</h3>
                    <div class="text-slate-600 leading-relaxed whitespace-pre-line text-lg">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-200">
                    <h4 class="font-semibold text-slate-900 mb-2">Tentang Perusahaan</h4>
                    <p class="text-slate-500 text-sm">
                        {{ $job->company }} adalah perusahaan terkemuka yang membuka kesempatan bagi talenta terbaik untuk bergabung dan berkembang bersama.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-lg p-6 sticky top-24">
                    <h3 class="font-bold text-lg text-slate-900 mb-6">Ringkasan Pekerjaan</h3>

                    <div class="space-y-4 mb-8">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Gaji yang ditawarkan</p>
                            <p class="text-xl font-bold text-slate-900">
                                Rp {{ number_format($job->salary, 0, ',', '.') }}
                                <span class="text-sm font-normal text-slate-500">/ bulan</span>
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Lokasi</p>
                            <p class="text-base font-medium text-slate-900">{{ $job->location }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Tipe Kontrak</p>
                            <p class="text-base font-medium text-slate-900">{{ $job->job_type }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="mailto:hr@example.com?subject=Lamaran untuk {{ $job->title }}" class="block w-full py-3 px-4 bg-black text-white font-bold text-center rounded-xl hover:bg-slate-800 transition shadow-md hover:shadow-lg hover:-translate-y-0.5 transform duration-200">
                            Lamar Sekarang
                        </a>

                        @auth
                            @can('edit', $job) 
                            {{-- Jika Anda menggunakan Policies, gunakan @can. Jika belum, pakai logika sederhana di bawah --}}
                                <a href="/jobs/{{ $job->id }}/edit" class="block w-full py-3 px-4 bg-white text-slate-900 border border-slate-200 font-bold text-center rounded-xl hover:bg-slate-50 hover:border-slate-300 transition">
                                    Edit Lowongan Ini
                                </a>
                            @else
                                {{-- Fallback jika belum setup Policies, tampilkan untuk semua user login (untuk tutorial) --}}
                                <a href="/jobs/{{ $job->id }}/edit" class="block w-full py-3 px-4 bg-white text-slate-900 border border-slate-200 font-bold text-center rounded-xl hover:bg-slate-50 hover:border-slate-300 transition">
                                    Edit Lowongan Ini
                                </a>
                            @endcan
                        @endauth
                    </div>

                    <p class="text-xs text-center text-slate-400 mt-4">
                        Jangan berikan uang untuk proses rekrutmen.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <footer class="bg-white border-t border-slate-200 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} JobBoard. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>