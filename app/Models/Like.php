<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tip_id', 'reply_id', 'ind'];

    public function user(): BelongsTo{
        return $this -> belongsTo(User::class);
    }

    public function reply(): BelongsTo{
        return $this -> belongsTo(Reply::class);
    }

    public function tip(): BelongsTo{
        return $this -> belongsTo(Tip::class);
    }

    public function scopeCheckLike(Builder $query, User|null $user, Tip|Reply $obj): Builder|Like|null {
        if($user !== null) {
            $query = $query -> where('user_id', $user -> id);
            
            if($query -> count()) {
                if($obj instanceof Tip){
                    return $query -> where('tip_id', '=', $obj -> id) -> first();
                } else {
                    return $query -> where('reply_id', '=', $obj -> id) -> first();
                }
            } else {
                return $query;
            }
        } else {
            return null;
        }
    }
}
