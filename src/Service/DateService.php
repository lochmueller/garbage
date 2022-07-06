<?php

namespace App\Service;

class DateService
{
    public function getNow(): \DateTime
    {
        return new \DateTime();
    }

    public function getSelectionStart(): \DateTime
    {
        return $this->getNow()->modify('-2 months');
    }

    public function getSelectionEnd(): \DateTime
    {
        return $this->getNow()->modify('+1 year');
    }
}
