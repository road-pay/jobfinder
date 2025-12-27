<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Lowongan - JobBoard</title>
    
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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded-lg font-bold text-lg">J</div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">JobBoard.</span>
                </a>
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-500 hover:text-black transition">Batal Edit</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Lowongan</h1>
                <p class="text-slate-500 mt-2">Perbarui informasi untuk: <span class="font-semibold text-slate-900">{{ $job->title }}</span></p>
            </div>
            
            <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini? Data tidak bisa dikembalikan.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-200 text-red-600 text-sm font-bold rounded-lg hover:bg-red-50 transition">
                    Hapus Lowongan
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <form method="POST" action="{{ route('jobs.update', $job->id) }}" class="p-8 space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Posisi Pekerjaan</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}"
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company" class="block text-sm font-semibold text-slate-700 mb-2">Nama Perusahaan</label>
                        <input type="text" name="company" id="company" value="{{ old('company', $job->company) }}"
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition" required>
                        @error('company') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Kantor</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}"
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition" required>
                        @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="salary" class="block text-sm font-semibold text-slate-700 mb-2">Gaji (IDR/Bulan)</label>
                        <input type="number" name="salary" id="salary" value="{{ old('salary', $job->salary) }}"
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition" required>
                        @error('salary') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="job_type" class="block text-sm font-semibold text-slate-700 mb-2">Tipe Pekerjaan</label>
                        <select id="job_type" name="job_type" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border bg-white transition">
                            @foreach(['Full Time', 'Part Time', 'Freelance', 'Contract', 'Internship'] as $type)
                                <option value="{{ $type }}" {{ old('job_type', $job->job_type) == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('job_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Pekerjaan</label>
                    <textarea name="description" id="description" rows="6" 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-3 border transition" required>{{ old('description', $job->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end gap-4">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition flex items-center">Batal</a>
                    <button type="submit" class="px-8 py-2.5 bg-black text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition shadow-lg transform active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="py-12 text-center text-slate-400 text-sm">
        &copy; {{ date('Y') }} JobBoard Platform.
    </footer>

</body>
</html>