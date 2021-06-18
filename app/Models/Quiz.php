<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_time', 'end_time', 'total_time', 'no_of_question'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function addQuestion($attributes)
    {
        $this->questions()->create($attributes);
    }
}
