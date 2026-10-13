<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $guarded = ['id'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function galleries()
    {
        return $this->hasMany(MotorGallery::class);
    }
}
