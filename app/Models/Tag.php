<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'organization_id',
    ];
    public function organizationintag(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function tagpost(): HasMany
    {
        return $this->hasMany(PostTag::class, 'tag_id', 'id');
    } 
}
