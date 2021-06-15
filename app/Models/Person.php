<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = "person";
    protected $fillable = [
        'uniq_id',
        'last_name',
        'first_name',
        'middle_name',
        'house_no',
        'street',
        'barangay',
        'city',
        'contact_no',
        'email',
        'rf_id',
        'auth',
        'level'
    ];
}
