<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $fillable =[
        'nom_role',
        'libelle'
    ];
    public function users():belongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
