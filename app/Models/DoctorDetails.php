<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'category',
        'experience',
        'bio_data',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
