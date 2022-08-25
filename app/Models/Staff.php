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

    public function picket()
    {
        return $this->hasOne(Picket::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }


    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}