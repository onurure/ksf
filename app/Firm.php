<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    protected $guarded = ['id'];
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function safe_accounts()
    {
        return $this->hasMany('App\SafeAccount');
    }

    public function incomings()
    {
        return $this->hasMany('App\Incoming');
    }
}
