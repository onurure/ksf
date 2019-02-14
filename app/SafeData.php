<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafeData extends Model
{
    protected $guarded = ['id'];

    public function safe_account()
    {
        return $this->belongsTo('App\SafeAccount');
    }
}
