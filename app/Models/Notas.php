<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';

    protected $fillable = [
        'valor',
        'turma_id',
        'professor_id',
    ];

    function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    function turmas()
    {
        return $this->belongsToMany(Turma::class, 'nota_turma', 'nota_id', 'turma_id');
    }
}
