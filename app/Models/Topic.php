<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasUuids, SoftDeletes;

    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function semester_topics(){
        return $this->hasMany(SemesterTopic::class);
    }

    public function lessions(){
        return $this->hasMany(Lession::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
}
