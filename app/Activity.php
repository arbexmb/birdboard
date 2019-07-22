<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    protected $casts = [
        'changes' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function userName()
    {
        return $this->user->is(auth()->user()) ? 'You' : $this->user->name;
    }
}
