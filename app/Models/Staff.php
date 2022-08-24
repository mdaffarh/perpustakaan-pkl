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

    public function staffUser()
    {
        return $this->hasOne(StaffUser::class);  
    }

    public function picket()
    {
        return $this->hasOne(Picket::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}