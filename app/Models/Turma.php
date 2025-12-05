<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['nome', 'disciplina_id', 'professor_id'];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function notas()
    {
        return $this->belongsToMany(Notas::class, 'nota_turma', 'turma_id', 'nota_id');
    }
}
