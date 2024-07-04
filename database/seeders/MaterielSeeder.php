<?php

namespace Database\Seeders;

use App\Models\Materiel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = file(storage_path('app/materiels_csv/materiels.csv'));
        foreach ($file as $line) {
            $csv_line = str_getcsv($line);


            $category_csv = trim($csv_line[0]);
            $category = \App\Models\Category::where('nom', $category_csv)->firstOr(function () use ($category_csv) {
                return \App\Models\Category::create([
                    'nom' => $category_csv
                ]);
            })->id;
            if ($csv_line[5]){
                $emplacement_csv = trim($csv_line[5]);

                $emplacement = \App\Models\Departement::where('nom',$emplacement_csv)->firstOr(function () use($emplacement_csv){
                    return \App\Models\Departement::create(['nom'=>$emplacement_csv,'locale_id' => 1]);
                })->id;
            }else {
                $emplacement =null;
            }
            $data = [
                'marque'=> trim($csv_line[1]),
                'nom'=> trim($csv_line[2]),
                'quantite'=> trim($csv_line[3]),
                'serial'=> $csv_line[4] ? trim($csv_line[4]) : null,
                'departement_id'=>$emplacement,
                'category_id'=>$category,
                'locale_id'=> 1,
                'statut'=>array_keys(Materiel::STATUS)[0],
            ];
            \App\Models\Materiel::create($data);
        }
    }
}
