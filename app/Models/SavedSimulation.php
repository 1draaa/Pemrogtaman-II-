<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedSimulation extends Model
{
    protected $fillable = [
        'user_id',
        'motor_name',
        'price',
        'dp',
        'tenor',
        'monthly_installment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
