<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id',
        'gallery_id',
    ];
    public function fileGallery(){
        return $this->belongsTo(File::class,'file_id');
    }
    public function galleryFile(){
        return $this->belongsTo(Gallery::class,'gallery_id');
    }
}
