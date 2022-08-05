<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'tb_staffs';
    protected $guarded = [
        'id'
    ];

    public function StaffUser()
    {
        return $this->hasOne(StaffUser::class);  
    }
}