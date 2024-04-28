<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'gender',
        'birthdate',
        'phone_number',
        'address',
        'user_id',
        'company_id',
    ];

    public function getAgeAttribute():int
    {
        return date_diff(date_create($this->birthdate), date_create('now'))->y;
    }

    public function getGenderNameAttribute():string
    {
        return $this->gender === 1 ? 'Nam' : 'Nữ';
    }

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projects():BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_people', 'person_id', 'project_code');
    }

    public function tasks():HasMany
    {
        return $this->hasMany(Task::class, 'person_id', 'id');
    }
}
