<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostTag extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'tag_id',
        'post_id',
    ];
    public function tagPost(){
        return $this->belongsTo(Tag::class,'tag_id');
    }
    public function postTag(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
