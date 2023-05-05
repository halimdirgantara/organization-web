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
    ];
    public function organizationinsocialmedia(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
}
