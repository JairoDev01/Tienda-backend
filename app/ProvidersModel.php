<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidersModel extends Model
{
    protected $table    = 'proveedores';
    protected $fillabel = [ 'id_proveedor',
                            'departamento',
                            'nombre',
                            'direccion',
                            'email',
                            'telefono'];
}
