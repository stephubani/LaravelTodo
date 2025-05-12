<?php

namespace App\Models;

use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Project extends Model
{
    //
   protected $fillable = [
    'name'
   ];
}
