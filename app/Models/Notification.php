<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_id',
        'user_id',
        'is_completed'
    ] ;

    public function updateStatus(){
        $this->is_completed = true;
        $this->save();
    }

    public function todo(){
        return $this->belongsTo(User::class);
    }
}
