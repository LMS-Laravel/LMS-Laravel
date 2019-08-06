<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Course
 * @package App\Entities
 *
 * @property int $id
 * @property string $name
 * @property string description
 */
class Course extends Model
{

    protected $fillable = ['name', 'description', 'teacher_id'];
    /**
     * @return BelongsTo
     */
    public function teacher() : BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * @return HasMany
     */
    public function lessons() : HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
