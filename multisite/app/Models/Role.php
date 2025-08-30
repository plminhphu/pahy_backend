<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
}
