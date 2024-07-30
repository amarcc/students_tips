<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function programs(): HasMany{
        return  $this -> hasMany(Program::class);
    }

    public function scopeWithProgramsCount(Builder $query): Builder{
        return $query -> withCount(['programs']);
    }

    public function scopeSearch(Builder $query, string $search): Builder{
        return $query -> where('name', 'like', '%'. $search .'%') -> orWhere('location', 'like', '%'. $search .'%');
    }
}
