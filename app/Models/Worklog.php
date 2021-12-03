<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worklog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    /**
     * Return the user for the worklog
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Retrieve the feedbacks for the worklog
     *
     * @return HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'worklog_id', 'id');
    }
}
