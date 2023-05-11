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
        'created_by',
    ];
    public function coverGallery(){
        return $this->belongsTo(File::class,'cover_id');
    }
    public function galleryOrganization(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function userGallery(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function galleryFile(): HasMany
    {
        return $this->hasMany(FileGallery::class, 'gallery_id', 'id');
    }
}
