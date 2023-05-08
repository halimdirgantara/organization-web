<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'abbreviation',
        'description',
        'address',
        'latitude',
        'longitude',
        'email',
        'phone',
        'fax',
        'logo',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    /**
     * Get all of the users for the Organization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'organzation_id', 'id');
    }    
    public function organizationinvisitor(): HasMany
    {
        return $this->hasMany(Visitor::class, 'organzation_id', 'id');
    }
    public function organizationinsocialmedia(): HasMany
    {
        return $this->hasMany(SocialMedia::class, 'organzation_id', 'id');
    }
    public function organizationincontactus(): HasMany
    {
        return $this->hasMany(ContactUs::class, 'organzation_id', 'id');
    }
    public function organizationintag(): HasMany
    {
        return $this->hasMany(Tag::class, 'organzation_id', 'id');
    }
    public function organizationinpost(): HasMany
    {
        return $this->hasMany(Post::class, 'organzation_id', 'id');
    }
    public function organizationincategory(): HasMany
    {
        return $this->hasMany(Category::class, 'organzation_id', 'id');
    }
    public function organizationinmenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'organzation_id', 'id');
    }    
    public function organizationFile(): HasMany
    {
        return $this->hasMany(File::class, 'organzation_id', 'id');
    }    
}
