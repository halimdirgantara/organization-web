<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilePost extends Model
{
    use HasFactory, SoftDeletes;
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
