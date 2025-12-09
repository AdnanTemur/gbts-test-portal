<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnic',
        'name',
        'father_name',
        'phone',
        'email',
        'photo',
    ];

    public function testAttempts(): HasMany
    {
        return $this->hasMany(TestAttempt::class)->orderBy('created_at', 'desc');
    }

    public function completedAttempts(): HasMany
    {
        return $this->hasMany(TestAttempt::class)
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc');
    }

    public function getBestScoreAttribute()
    {
        return $this->completedAttempts()->max('percentage');
    }

    public function getLatestAttemptAttribute()
    {
        return $this->testAttempts()->first();
    }
}
