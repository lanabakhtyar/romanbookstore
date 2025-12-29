<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Translator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TranslatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $translators=[
            'varo ali',
            'ravin kamaran',
            'lava omer',
            'peshawa rasul',
            'prusha hussein', 
            'shama faraidun',
            'peshawa xalid'
        ];
      $languageIds = Language::pluck('id')->toArray();

       
        foreach ($translators as $translator) {
            Translator::firstOrCreate(
                ['name' => $translator],
                ['native_language_id' => $languageIds[array_rand($languageIds)]]
            );


        }}
}
