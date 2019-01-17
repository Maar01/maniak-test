<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            ['name' => 'Drama',   'description' => 'Stories composed in verse or prose, usually for theatrical performance, where conflicts and emotion are expressed through dialogue and action.',],
            ['name' => 'Fable',   'description' => 'Narration demonstrating a useful truth, especially in which animals speak as humans; legendary, supernatural tale. ',],
            ['name' => 'Legend',  'description' => 'Story, sometimes of a national or folk hero, which has a basis in fact but also includes imaginative material.',],
            ['name' => 'Horror',  'description' => 'Fiction in which events evoke a feeling of dread in both the characters and the reader. ',],
            ['name' => 'Fantasy', 'description' => 'Fiction with strange or other worldly settings or characters; fiction which invites suspension of reality. ',],
            ['name' => 'Fiction', 'description' => 'Narrative literary works whose content is produced by the imagination and is not necessarily based on fact. ',],
            ['name' => 'Mystery', 'description' => 'Fiction dealing with the solution of a crime or the unraveling of secrets. ',],
            ['name' => 'Poetry',  'description' => 'Verse and rhythmic writing with imagery that creates emotional responses. ',],
            ['name' => 'Science Fiction ', 'description' => ' Story based on impact of actual, imagined, or potential science, usually set in the future or on other planets. ',],

        ]);
    }
}
