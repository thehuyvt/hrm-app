<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Person::class, 'project_people');
    }
}
