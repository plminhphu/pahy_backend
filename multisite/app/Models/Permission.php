<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'title',
        'getall',
        'getone',
        'created',
        'updated',
        'deleted',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
