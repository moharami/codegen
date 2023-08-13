<?php

namespace Moharamiamir\codegen\Console\Commands;

class getSeeder extends makeArray
{

    public function get()
    {
        return $this->inputs .'::factory()->count(20)->create();';
    }

}