<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotacionesDetalles extends Model
{
    use HasFactory,SoftDeletes;

	protected $table = 'votaciones_detalle';

    protected $fillable = [
        'votaciones_id',
        'redes_sociales_id',
        'tiempo_prom'
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

}
