<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTitle extends Model
{
    use HasFactory;

    protected $table = 'question_titles';
    protected $fillable = ['nama'];

    public function skillTests() 
    {
        return $this->hasOne(SkillTest::class);
    }
}
