<?php

namespace AppBundle\Service;

use Hashids\Hashids;

class CodeGeneratorService
{
    private $salt;

    /**
     * CodeGeneratorService constructor.
     * @param $salt
     */
    public function __construct($salt)
    {
        $this->salt = $salt;
    }

    public function generateCode()
    {
        $hashIds = new Hashids($this->salt);
        return $hashIds->encode(time() - 1000000000);
    }
}
