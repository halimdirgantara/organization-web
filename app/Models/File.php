<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'file',
        'file_type',
        'description',
        'size',
        'downloaded',
        'organization_id',
        'created_by',
    ];
    public function organizationFile(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function userFile(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function coverGallery(): HasMany
    {
        return $this->hasMany(Gallery::class, 'cover_id', 'id');
    }
    public function filePost(): HasMany
    {
        return $this->hasMany(FilePost::class, 'file_id', 'id');
    }
    public function fileGallery(): HasMany
    {
        return $this->hasMany(FileGallery::class, 'file_id', 'id');
    }
    public function fileToPost(): HasMany
    {
        return $this->hasMany(Post::class, 'feature_image', 'id');
    }
}
