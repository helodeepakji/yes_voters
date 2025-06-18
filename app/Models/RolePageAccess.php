<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePageAccess extends Model
{
    use HasFactory;

    protected $table = 'role_page_access';

    protected $fillable = [
        'role_id',
        'page_id',
    ];

    // Relationship with Role Model
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relationship with Page Model
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}