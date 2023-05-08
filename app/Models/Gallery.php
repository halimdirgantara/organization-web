<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'cover_id',
        'organization_id',
    ];
    public function galleryFile(){
        return $this->belongsTo(File::class,'cover_id');
    }
    public function galleryOrganization(){
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
    public function galleryPost(): HasMany
    {
        return $this->hasMany(FileGallery::class, 'gallery_id', 'id');
    }
    public function gallerytoFile(): HasMany
    {
        return $this->hasMany(FileGallery::class, 'gallery_id', 'id');
    }
}
