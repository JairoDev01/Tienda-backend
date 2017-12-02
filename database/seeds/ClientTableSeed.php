<?php

use Illuminate\Database\Seeder;
use Faker\Provider\pt_BR\PhoneNumber as phoneN;
use Faker\Provider\es_ES\Person as Person;


class ClientTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $faker->addProvider(new phoneN($faker));
        $faker->addProvider(new Person($faker));
        for($i=0; $i<50;$i++){
            \DB::table('clientes')->insert(array(
                'nombre'    =>$faker->firstNameMale,
                'apellido'  =>$faker->lastName,
                'direccion' =>$faker->address,
                'email'     =>$faker->unique()->freeEmail,
                'NIT'       =>$faker->dni,
                'telefono'  =>$faker->phone,
                'fecha_nacimiento'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                'created_at'=>$faker->dateTime($max = 'now',$timezone='America/Guatemala'),
                'updated_at'=>$faker->dateTime($max = 'now',$timezone='America/Guatemala'),
            ));
        }
    }
}
