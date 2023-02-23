<?php

namespace App\Exceptions;

use Exception;

class ProudctNotInThisUser extends Exception
{
    public function render()
    {
        return ['data'=>'Product Not Belong To User'];
    }
}
