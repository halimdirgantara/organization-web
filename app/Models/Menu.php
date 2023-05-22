<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'url',
        'order',
        'menu_type',
        'organization_id',
        'category_id',
        'post_id',
        'tag_id',
        'parent_id',
    ];
    public function organizationMenu(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function categoryMenu(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function postMenu(){
        return $this->belongsTo(Post::class,'post_id');
    }
    public function tagMenu(){
        return $this->belongsTo(Tag::class,'tag_id');
    }
    public function parentMenu(){
        return $this->belongsTo(Menu::class,'parent_id');
    }
    public function childMenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
