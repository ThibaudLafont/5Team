<?php
namespace App\Office;

class DeveloperOffice extends Office
{
    public function freeSpaceRate(): int
    {
        return
            ($this->getWorkers()-3*$this->getNetworkPlugs())  +
            ($this->getWorkers()-3*$this->getElectricPlugs()) +
            ($this->getWorkers()-$this->getPhonePlugs())      +
            ($this->getWorkers()-1.5*$this->getChairs())      +
            ($this->getWorkers()-$this->getDesks());
    }
}