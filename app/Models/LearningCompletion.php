<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningCompletion extends Model
{
    protected $fillable = ['user_id', 'type', 'item_key', 'completed_at'];

    protected function casts(): array
    {
        return ['completed_at' => 'datetime'];
    }
}
