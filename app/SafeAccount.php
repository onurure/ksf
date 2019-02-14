<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafeAccount extends Model
{
    protected $guarded = ['id'];

    public function firm()
    {
        return $this->belongsTo('App\Firm');
    }

    public function safe_datas()
    {
        return $this->hasMany('App\SafeData');
    }
}
