<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'date_of_birth',
        'gender',
        'blood_group',
        'marital_status',
        'height',
        'weight',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
