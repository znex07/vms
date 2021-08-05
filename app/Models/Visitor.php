<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'person_to_visit',
        'purpose',
        'destination',
        'last_name',
        'first_name',
        'middle_name',
        'house_no',
        'street',
        'barangay',
        'city',
        'contact_no',
        'email',
    ];
}
