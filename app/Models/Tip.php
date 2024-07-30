<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'program_id', 'user_id', 'edited', 'created_at', 'updated_at'];

    public function program(): BelongsTo{
        return $this -> belongsTo(Program::class);
    }
    public function likes(): HasMany{
        return $this -> hasMany(Like::class);
    }

    public function user(): BelongsTo{
        return $this -> belongsTo(User::class);
    }

    public function replies(): HasMany{
        return $this -> HasMany(Reply::class);
    }

    public function scopeWithRepliesCount(Builder $query): Builder{
        return $query -> withCount(['replies']);
    }

    public function scopeWithLikesCount(Builder $query): Builder{
        return $query -> withCount(['likes']);
    }

    public function scopeSearch(Builder $query, string $search): Builder{
        return $query -> where('title', 'like','%'. $search .'%') -> orWhere('desc', 'like','%'. $search .'%');
    }

    public function scopeMostLikes(Builder $query): Builder{
        return $query -> orderby('likes_count', 'desc');
    }
    
}
