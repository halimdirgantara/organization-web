<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'file',
        'file_type',
        'description',
        'size',
        'downloaded',
        'organization_id',
    ];
    public function organizationFile(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    // public function categoryMenu(){
    //     return $this->belongsTo(Category::class,'category_id');
    // }
    // public function postMenu(){
    //     return $this->belongsTo(Post::class,'post_id');
    // }
    // public function tagMenu(){
    //     return $this->belongsTo(Tag::class,'tag_id');
    // }
    // public function parentMenu(){
    //     return $this->belongsTo(Menu::class,'parent_id');
    // }
    public function filePost(): HasMany
    {
        return $this->hasMany(FilePost::class, 'file_id', 'id');
    }
    public function fileGallery(): HasMany
    {
        return $this->hasMany(FileGallery::class, 'file_id', 'id');
    }
}
