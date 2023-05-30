<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;

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
    public function user()
    {
        return $this->hasMany(User::class, 'organization_id', 'id');
    }

    public function organizationVisitor(): HasMany
    {
        return $this->hasMany(Visitor::class, 'organzation_id', 'id');
    }

    public function organizationSocialMedia(): HasMany
    {
        return $this->hasMany(SocialMedia::class, 'organzation_id', 'id');
    }

    public function organizationContactUs(): HasMany
    {
        return $this->hasMany(ContactUs::class, 'organzation_id', 'id');
    }

    public function organizationTag(): HasMany
    {
        return $this->hasMany(Tag::class, 'organzation_id', 'id');
    }

    public function organizationPost(): HasMany
    {
        return $this->hasMany(Post::class, 'organzation_id', 'id');
    }

    public function organizationCategory(): HasMany
    {
        return $this->hasMany(Category::class, 'organzation_id', 'id');
    }

    public function organizationMenu(): HasMany
    {
        return $this->hasMany(Menu::class, 'organzation_id', 'id');
    }

    public function organizationFile(): HasMany
    {
        return $this->hasMany(File::class, 'organzation_id', 'id');
    }

    public function galleryOrganization(): HasMany
    {
        return $this->hasMany(Gallery::class, 'organzation_id', 'id');
    }

    public function organizationHasPost(): HasMany
    {
        return $this->hasMany(PostOrganization::class, 'organzation_id', 'id');
    }

}
