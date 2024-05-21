<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        
    ];

    public function roles() : BelongsToMany{
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

}
