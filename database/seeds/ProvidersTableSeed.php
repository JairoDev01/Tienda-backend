<?php

use Illuminate\Database\Seeder;

use Faker\Provider\pt_BR\PhoneNumber as phoneN;

class ProvidersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new phoneN($faker));
        $faker->addProvider(new CompanyNameGenerator\FakerProvider($faker));
        for($i=0; $i<50;$i++){
            \DB::table('proveedores')->insert(array(
                'nombre'    =>$faker->companyName,
                'direccion' =>$faker->address,
                'email'     =>$faker->unique()->freeEmail,
                'telefono'  =>$faker->phone,
                'created_at'=>$faker->dateTime($max = 'now',$timezone='America/Guatemala'),
                'updated_at'=>$faker->dateTime($max = 'now',$timezone='America/Guatemala'),
            ));
        }
    }
}
