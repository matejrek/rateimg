<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',  'objava_id'
    ];

}
