<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitorlog extends Model
{
    use HasFactory;
    protected $fillable=[
        'visitor_id',
        'url',
    ];
    public function visitor(){
        return $this->belongsTo(Visitor::class,'visitor_id');
    }
}
