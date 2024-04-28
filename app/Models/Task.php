<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'project_id',
        'person_id',
        'priority',
        'status',
        'start_time',
        'end_time',
    ];

//    protected $casts = [
//        'priority' => TaskPriorityEnum::class,
//        'status' => TaskStatusEnum::class,
//    ];

    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'code');
    }

    public function person():BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

}
