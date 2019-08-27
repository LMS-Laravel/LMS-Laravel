<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['message', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messageable()
    {
        return $this->morphTo();
    }
}
