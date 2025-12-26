<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // 1. Tampilkan Daftar Lowongan (Halaman Utama Dashboard)
    public function index()
    {
        // Ambil semua data job, urutkan dari yang terbaru
        $jobs = Job::latest()->get();
        return view('dashboard', compact('jobs'));
    }

    // 2. Tampilkan Formulir Buat Lowongan Baru
    public function create()
    {
        return view('jobs.create');
    }

    // 3. Simpan Data Lowongan ke Database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required',
            'salary' => 'nullable|numeric',
        ]);

        // Simpan ke database
        Job::create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'salary' => $request->salary,
            'description' => $request->description,
            'user_id' => Auth::id(), // ID user yang sedang login
        ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Lowongan berhasil diposting!');
    }
}