<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lession extends Model
{
    use HasUuids, SoftDeletes;

    protected $guarded = [];

    public function studentlessons(){
        return $this->hasMany(StudentLession::class, 'lession_id');
    }
    
}
