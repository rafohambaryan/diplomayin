<?php

use Illuminate\Database\Seeder;
use App\Models\ContentType;

class ContentTypeSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['json', 'img'];
        foreach ($types as $index => $type) {
            ContentType::create([
                'type' => $type
            ]);
        }
    }
}
