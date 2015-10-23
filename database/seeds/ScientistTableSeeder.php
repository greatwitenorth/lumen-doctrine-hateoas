<?php

use Illuminate\Database\Seeder;

class ScientistTableSeeder extends Seeder
{
    protected $repo;

    public function __construct( \App\Repositories\ScientistRepository $repo ) {
        $this->repo = $repo;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++){
            $this->repo->createFake();
        }
    }
}
