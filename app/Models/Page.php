<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_page_access');
    }
}