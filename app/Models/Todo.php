<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'is_completed',
        'completed_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function displayStatus(){
        return $this->is_completed ? 'Completed' : 'Not Completed';
    }
    
    

}
