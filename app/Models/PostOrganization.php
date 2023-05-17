<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostOrganization extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'organization_id',
        'post_id',
    ];
    public function organizationHasPost(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function postHasOrganization(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
