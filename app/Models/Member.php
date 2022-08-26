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
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    protected $with = ['creator','editor'];

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    public function editor()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

}