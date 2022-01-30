<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

class Team extends Model
{
    protected $fillable = [
        'group'
    ];

    public function parent()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function children()
    {
        return $this->hasMany(Team::class, 'team_id');
    }
}
