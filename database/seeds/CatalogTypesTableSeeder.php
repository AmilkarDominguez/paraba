<?php

use Illuminate\Database\Seeder;

class CatalogTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TypeCatalog::create([
            'name' => 'Pais',
            'description' => 'Países de Turistas.',
            'state' => 'ACTIVO'
        ]);
        
        App\TypeCatalog::create([
            'name' => 'Tipo documento',
            'description' => 'Tipos de documento de turistas.',
            'state' => 'ACTIVO'
        ]);

        App\TypeCatalog::create([
            'name' => 'Ocupación',
            'description' => 'Tipos de Ocupación de turistas.',
            'state' => 'ACTIVO'
        ]);
        //Para Contenido (publicaciones)
        App\TypeCatalog::create([
            'name' => 'Idioma',
            'description' => 'Tipos de idiomas para publicaciones.',
            'state' => 'ACTIVO'
        ]);

        App\TypeCatalog::create([
            'name' => 'Etiqueta',
            'description' => 'Etiquetas para publicaciones.',
            'state' => 'ACTIVO'
        ]);
        
        App\TypeCatalog::create([
            'name' => 'Tipo transporte',
            'description' => 'Tipos de transporte.',
            'state' => 'ACTIVO'
        ]);
        App\TypeCatalog::create([
            'name' => 'Tipo ubicación',
            'description' => 'Tipos de unbicaciones turisticas.',
            'state' => 'ACTIVO'
        ]);
    }
}
