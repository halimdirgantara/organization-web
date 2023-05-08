<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePost extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id',
        'post_id',
    ];
    public function filePost(){
        return $this->belongsTo(File::class,'file_id');
    }
    public function postFile(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
