<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'ratings',
        'reviews',
        'reviewed by',        
        'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(DoctorDetails::class, 'doctor_id', 'doctor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
