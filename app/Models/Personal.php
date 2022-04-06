<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = "personal";

    protected $fillable = [
        'personal_codigo',
        'personal_nombre',
        'personal_profesion',
        'personal_estado'
    ];

    public function obras()
    {
        return $this->belongsToMany('App\Models\Obra');
    }

}
