<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = ['id'];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function leasing()
    {
        return $this->belongsTo(Leasing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
