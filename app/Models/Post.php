<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'body',
        'post_type',
        'status',
        'views',
        'is_headline',
        'is_main_side',
        'organization_id',
        'shared_by',
        'shared_status',
        'feature_image',
        'category_id',
        'created_by',
        'updated_by',
    ];
    public function organizationPost(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function postShared(){
        return $this->belongsTo(User::class,'shared_by');
    }
    public function fileToPost(){
        return $this->belongsTo(File::class,'feature_image');
    }
    public function userincreated(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function userinupdated(){
        return $this->belongsTo(User::class,'updated_by');
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
