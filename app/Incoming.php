<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    public function firm()
    {
        return $this->belongsTo('App\Firm');
    }
}
