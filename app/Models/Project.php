<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    protected $fillable = [
        'name',
        'description',
        'company_id'
    ];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function people():BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'project_people', 'project_code', 'person_id');
    }

    public function tasks():HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'code');
    }
}
