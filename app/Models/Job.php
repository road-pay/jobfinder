<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // UBAH INI: Kita pakai User, bukan Employer

class Job extends Model
{
    use HasFactory;

    // Jurus Anti-Ribet:
    protected $guarded = [];

    // Kita tetap namakan fungsinya 'employer' agar kode di View tidak error.
    // TAPI, isinya kita arahkan ke class User.
    public function employer()
    {
        // Artinya: "Penyedia kerja (employer) ini sebenarnya adalah User (pemilik user_id)"
        return $this->belongsTo(User::class, 'user_id');
    }
}