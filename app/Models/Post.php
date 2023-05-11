<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'body',
        'feature_image',
        'category_id',
        'post_type',
        'status',
        'created_by',
        'updated_by',
        'organization_id',
        'views',
        'is_headline',
        'is_main_side',
    ];
    // public function fileinpost(){
    //     return $this->belongsTo(File::class,'feature_image');
    // }
    // public function categoryinpost(){
    //     return $this->belongsTo(Category::class,'category_id');
    // }
    public function userincreated(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function userinupdated(){
        return $this->belongsTo(User::class,'updated_by');
    }
    public function organizationPost(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function categoryPost(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function postTag(): HasMany
    {
        return $this->hasMany(PostTag::class, 'post_id', 'id');
    } 
    public function postMenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'post_id', 'id');
    }
    public function postFile(): HasMany
    {
        return $this->hasMany(FilePost::class, 'post_id', 'id');
    }
}
