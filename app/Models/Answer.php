<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['survey_response_id', 'question', 'answer','ai_answer'];

    public function response()
    {
        return $this->belongsTo(SurveyResponse::class, 'survey_response_id');
    }
}
