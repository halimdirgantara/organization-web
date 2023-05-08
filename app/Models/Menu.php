<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
        'organization_id',
        'category_id',
        'post_id',
        'tag_id',
        'parent_id',
        'order',
        'menu_type',
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
