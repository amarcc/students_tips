<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['desc', 'user_id', 'tip_id', 'created_at', 'updated_at', 'edited'];

    public function user(): BelongsTo{
        return $this -> belongsTo(User::class);
    }

    public function Tip(): BelongsTo{
        return $this -> belongsTo(Tip::class);
    }
    
    public function likes(): HasMany{
        return $this -> hasMany(Like::class);
    }

    public function scopeWithLikesCount(Builder $query): Builder{
        return $query -> withCount(['likes']);
    }
}
