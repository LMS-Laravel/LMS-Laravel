<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use VanOns\Laraberg\Models\Gutenbergable;

class Lesson extends Model
{
    use Gutenbergable;

    protected  $fillable = ['title', 'content', 'course_id'];

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
