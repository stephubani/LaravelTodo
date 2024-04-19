<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'is_active'];

    public function displayLabel(){
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function toggleStatus(){
        // if($this->is_active){
        //     $this->is_active = 0;
        // }else{
        //     $this->is_active = 1;
        // }

        $this->is_active = ! $this->is_active;
        $this->save();
    }

  
}
