<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';

    protected $fillable = [
        'team_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

     public function members()
    {
        return $this->hasMany(User::class);
    }

    public function leader()
    {
        return $this->hasOne(User::class)->where('is_team_leader', true);
    }
}
