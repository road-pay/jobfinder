<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employer; 

class Job extends Model
{
    use HasFactory;

    // Jurus Anti-Ribet:
    // Ini artinya: "Jangan ada kolom yang dijaga, izinkan semua data masuk"
    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}