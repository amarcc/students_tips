<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'faculty_id'];

    public function faculty(): BelongsTo{
        return $this -> belongsTo(Faculty::class);
    }

    public function tips(): HasMany{
        return $this -> hasMany(Tip::class);
    }
    
    public function scopeWithTipsCount(Builder $query): Builder{
        return $query -> withCount(['tips']);
    }

    public function scopeSearch(Builder $query, string $search): Builder{
        return $query -> where('name', 'like','%'. $search .'%');
    }
}
