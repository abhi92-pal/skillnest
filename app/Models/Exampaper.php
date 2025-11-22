<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exampaper extends Model
{
    use HasUuids, SoftDeletes;

    protected $guarded = [];

    public function questiontypes(){
        return $this->belongsToMany(Questiontype::class)->withPivot('description', 'total_questions', 'evaluted_question_nos');
    }
    
    public function semester(){
        return $this->belongsTo(Semester::class);
    }
    
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    
    public function examslot(){
        return $this->belongsTo(Examslot::class);
    }
}
