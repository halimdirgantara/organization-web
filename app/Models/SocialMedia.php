<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
        'icon',
        'order',
        'is_active',
        'organization_id',
    ];
    public function organizationSocialMedia(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
}
