<?php
namespace App\Office;

class CommercialOffice extends Office
{
    public function freeSpaceRate(): int
    {
        return
            ($this->getWorkers()-$this->getNetworkPlugs())  +
            ($this->getWorkers()-$this->getElectricPlugs()) +
            ($this->getWorkers()-2*$this->getPhonePlugs())  +
            ($this->getWorkers()-2*$this->getChairs())      +
            ($this->getWorkers()-$this->getDesks());
    }
}