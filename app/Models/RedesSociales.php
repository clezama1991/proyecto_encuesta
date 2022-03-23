<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RedesSociales extends Model
{
	protected $table = 'redes_sociales';
    protected $fillable = [
        'name',
        'icono',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function votaciones()
    {
        return $this->hasMany('App\Models\Votaciones', 'favorita_id', 'id');
    }
    
}
