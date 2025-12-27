<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * --- BAGIAN PUBLIK ---
     */

    public function index()
    {
        // Ambil data terbaru
        $query = Job::latest();

        // Logic Pencarian yang lebih aman dengan grouping query
        if (request('q')) {
            $searchTerm = '%' . request('q') . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('company', 'like', $searchTerm)
                  ->orWhere('location', 'like', $searchTerm);
            });
        }

        return view('welcome', [
            'jobs' => $query->paginate(10)->withQueryString()
        ]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * --- BAGIAN DASHBOARD (USER LOGIN) ---
     */

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'salary'      => 'nullable|numeric|min:0',
            'job_type'    => 'required|string',
            'description' => 'required|string|min:10',
        ]);

        // Simpan otomatis menggunakan ID user yang sedang login
        $request->user()->jobs()->create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Lowongan berhasil diposting!');
    }

    /**
     * --- FITUR EDIT, UPDATE & DELETE ---
     */

    public function edit(Job $job)
    {
        // Keamanan: Pastikan hanya pemilik yang bisa masuk ke halaman edit
        if ($job->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah lowongan ini.');
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        // Keamanan: Proteksi sisi server agar user lain tidak bisa kirim request update
        if ($job->user_id !== Auth::id()) {
            abort(403, 'Tindakan tidak diizinkan.');
        }

        $validatedData = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'salary'      => 'nullable|numeric|min:0',
            'job_type'    => 'required|string',
            'description' => 'required|string|min:10',
        ]);

        // Eksekusi Update
        $job->update($validatedData);

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(Job $job)
    {
        // Keamanan: Pastikan hanya pemilik yang bisa menghapus
        if ($job->user_id !== Auth::id()) {
            abort(403, 'Tindakan tidak diizinkan.');
        }

        $job->delete();

        return redirect()->route('dashboard')->with('success', 'Lowongan berhasil dihapus.');
    }
}