<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'organization_id',
        'created_by',
    ];
    public function organizationCategory(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function userCategory(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function categoryPost(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function categoryMenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'category_id', 'id');
    }
}
