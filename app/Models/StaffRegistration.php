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

    protected $with = ['creator','editor'];

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

    public function admin()
    {
        return $this->belongsTo(Staff::class, 'user_verifikasi');
    }

}