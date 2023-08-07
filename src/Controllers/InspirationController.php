<?php
namespace Moharamiamir\codegen\Controllers;

use Illuminate\Http\Request;
use Moharamiamir\codegen\Inspire;

class InspirationController
{
    public function __invoke(Inspire $inspire) {
        $quote = $inspire->justDoIt();

        return $quote;
    }
}
