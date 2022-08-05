<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRegistration extends Model
{
    use HasFactory;

    protected $table = 'trx_staff_registrations';
    protected $guarded = [
        'id'
    ];
}