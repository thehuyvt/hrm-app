<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'is_active',
    ];

    public function getActiveNameAttribute():string
    {
        return $this->is_active === 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt';
    }

    public function person():HasOne
    {
        return $this->hasOne(Person::class);
    }

    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }


}
