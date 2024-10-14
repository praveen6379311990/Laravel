<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class addTasks extends Model
{

    protected $table = 'add_tasks'; // Specify the table if not using 'tasks'

    public function users()
    {
        return $this->belongsToMany(AddUser::class, 'user_tasks', 'task_id', 'user_id');
    }
}
