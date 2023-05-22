<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'category',
        'is_read',
        'organization_id',
        'read_by',
    ];
    public function organizationContactUs(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    public function userContactUs(){
        return $this->belongsTo(User::class,'read_by');
    }
}
