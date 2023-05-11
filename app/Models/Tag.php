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
        'created_by',
    ];
    public function organizationTag(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function userTag(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function tagPost(): HasMany
    {
        return $this->hasMany(PostTag::class, 'tag_id', 'id');
    } 
    public function tagMenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'tag_id', 'id');
    } 
}
