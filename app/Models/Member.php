<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'tb_members';
    protected $guarded = [
        'id'
    ];

    public function MemberUser()
    {
        return $this->hasOne(MemberUser::class);  
    }

}