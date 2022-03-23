<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encuestados extends Model
{ 
    
	protected $table = 'encuestados';

    protected $fillable = [
        'nombre',
        'correo',
        'edad',
        'sexo'
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

    public function votacion()
    {
        return $this->belongsTo(Votaciones::class, 'id', 'user_id');
    }
}
