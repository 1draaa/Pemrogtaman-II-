<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorGallery extends Model
{
    protected $fillable = ['motor_id', 'foto_path'];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
