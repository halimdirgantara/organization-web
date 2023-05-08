<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'organization_id',
    ];
    public function categoryPost(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function categoryMenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'category_id', 'id');
    }
    public function organizationCategory(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
}
