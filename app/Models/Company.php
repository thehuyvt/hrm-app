<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'code',
      'address',
    ];

    public function person(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function department(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function projects():HasMany
    {
        return $this->hasMany(Project::class);
    }

}
