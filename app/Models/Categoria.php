<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    /**
     * Obtener los productos asociados a la categoría.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
