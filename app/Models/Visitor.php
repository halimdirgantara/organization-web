<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'user_agent',
        'device_id',
        'location',
        'coordinate',
        'is_online',
        'organization_id',
    ];
    public function visitor_log(){
        return $this->hasMany(VisitorLog::class);
    }
    public function organizationVisitor(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
}
