<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questiontype extends Model
{
    use HasUuids, SoftDeletes;

    protected $guarded = [];
    
    public function exampapers(){
        return $this->belongsToMany(Exampaper::class)->withPivot('description', 'total_questions', 'evaluted_question_nos');
    }
}
