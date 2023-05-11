<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'phone',
        'address',
        'facebook',
        'instagram',
        'twitter',
        'parent_id',
    ];

    public function parent(){
        return $this->belongsTo(Team::class,'parent_id');
    }
    public function child(): HasMany
    {
        return $this->hasMany(Team::class, 'parent_id', 'id');
    } 
}
