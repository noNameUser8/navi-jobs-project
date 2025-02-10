<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'city',
        'address',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
