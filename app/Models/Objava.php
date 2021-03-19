<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Rating;
use App\Models\PublicRating;

class Objava extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'imgPath', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratingsLike(){
        return $this->hasMany(Rating::class)->where('type',1);
    }

    public function publicRatingsLike(){
        return $this->hasMany(PublicRating::class)->where('type',1);
    }
    
    public function ratingsDislike(){
        return $this->hasMany(Rating::class)->where('type',0);
    }

    public function publicRatingsDislike(){
        return $this->hasMany(PublicRating::class)->where('type',0);
    }


}
