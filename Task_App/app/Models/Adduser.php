<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adduser extends Model
{
    use HasFactory;

    protected $table = 'addusers'; // Specify the table if not using 'users'

    public function tasks()
    {
        return $this->belongsToMany(addTasks::class, 'user_tasks', 'user_id', 'task_id');
    }
}
