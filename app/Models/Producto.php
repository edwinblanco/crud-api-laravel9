<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'descripcion', 'cantidad', 'precio', 'imagen'];

    /**
     * Obtener la categoría asociada al producto.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
