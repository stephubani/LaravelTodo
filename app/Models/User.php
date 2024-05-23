<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Role;
use App\Models\Todo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function toggleStatus(){
        $this->is_active = ! $this->is_active;
        $this->save();
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function displayStatusOfUser(){
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function todos(){
        return $this->hasMany(Todo::class);
    }

    public function isSuperUser(){
        if(Str::contains($this->name , 'Super')){
            return true;
        }else{
            return false;
        };
    }
}
