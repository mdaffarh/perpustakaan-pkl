<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picket extends Model
{
    use HasFactory;

    protected $table = 'tb_pickets';
    protected $guarded = [
        'id'
    ];

    protected $with = ['staff'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id' );
    }

}