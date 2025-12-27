<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pasang Lowongan Baru - JobBoard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script> tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } } } } </script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="font-bold text-xl tracking-tight text-slate-900">JobBoard.</a>
                <a href="/dashboard" class="text-sm font-medium text-slate-500 hover:text-black">Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Buat Lowongan Baru</h1>
            <p class="text-slate-500 mt-2">Isi detail pekerjaan dengan lengkap untuk menarik pelamar terbaik.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <form method="POST" action="/jobs" class="p-8 space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Posisi Pekerjaan</label>
                    <input type="text" name="title" id="title" placeholder="Contoh: Senior UI/UX Designer" 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-2.5 border" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company" class="block text-sm font-semibold text-slate-700 mb-2">Nama Perusahaan</label>
                        <input type="text" name="company" id="company" placeholder="Contoh: GoTo, Tokopedia" 
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-2.5 border" required>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Kantor</label>
                        <input type="text" name="location" id="location" placeholder="Contoh: Jakarta Selatan, Remote" 
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-2.5 border" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="salary" class="block text-sm font-semibold text-slate-700 mb-2">Gaji (IDR/Bulan)</label>
                        <input type="number" name="salary" id="salary" placeholder="Contoh: 15000000" 
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-2.5 border" required>
                    </div>

                    <div>
                        <label for="job_type" class="block text-sm font-semibold text-slate-700 mb-2">Tipe Pekerjaan</label>
                        <select id="job_type" name="job_type" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-2.5 border bg-white">
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Pekerjaan</label>
                    <textarea name="description" id="description" rows="6" placeholder="Jelaskan tanggung jawab dan kualifikasi..." 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-black focus:ring-black sm:text-sm p-2.5 border" required></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-4">
                    <a href="/dashboard" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition">Batal</a>
                    <button type="submit" class="px-5 py-2.5 bg-black text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition shadow-lg">
                        Terbitkan Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>