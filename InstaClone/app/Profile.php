<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $guarded = [];

    public function profileImage(){
        $imagePath = ($this->image) ?  $this->image : '/profile/L69Ty6WwTzythbCUgozJ1bKfCTGDJ4TtsRTCG5me.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
