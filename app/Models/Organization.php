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
}
