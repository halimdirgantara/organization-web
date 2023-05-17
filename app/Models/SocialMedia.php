<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'url',
        'icon',
        'order',
        'is_active',
        'organization_id',
        'created_by',
    ];
    public function organizationSocialMedia(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function userSocialMedia(){
        return $this->belongsTo(User::class,'created_by');
    }
}
