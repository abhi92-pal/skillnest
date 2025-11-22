<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examslot extends Model
{
    use HasUuids, SoftDeletes;

    protected $guarded = [];

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function exampapers(){
        return $this->hasMany(Exampaper::class);
    }
    
}
