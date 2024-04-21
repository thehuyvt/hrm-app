<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
//    public $primaryKey = 'code';

    protected $fillable=[
        'code',
        'name',
        'parent_id',
        'company_id',
    ];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(Department::class, 'parent_id','code');
    }

    public function child():HasMany
    {
        return $this->hasMany(Department::class, 'parent_id', 'code');
    }

    public static function tree($allDepartments)
    {

        $rootDepartments = $allDepartments->whereNull('parent_id');

        self::formatTree($rootDepartments, $allDepartments);

        return $rootDepartments;
    }

    private static function formatTree($departments, $allDepartments)
    {
        foreach ($departments as $department) {
            $department->child = $allDepartments->where('parent_id', $department->code)->values();

            if ($department->child->isNotEmpty()) {
                self::formatTree($department->child, $allDepartments);
            }
        }
    }

}
