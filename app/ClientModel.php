<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    protected $table    = 'clientes';
    protected $fillabel = [ 'id_cliente',
                            'nombre',
                            'apellido',
                            'direccion',
                            'email',
                            'NIT',
                            'telefono',
                            'fecha_nacimiento'];
}
