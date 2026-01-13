<?php

namespace Database\Seeders;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $languages = [
            'English',
            'Arabic',
            'Kurdish',
            'French',
            'German',
            'Spanish',
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate([
                'name' => $language,
                'slug' => Str::slug($language)
            ]);
        
        }
    }
}
 