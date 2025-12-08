<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';

    protected $fillable = [
        'valor',
        'turma_id',
        'aluno_id',
    ];

    function usuario()
    {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }
}
