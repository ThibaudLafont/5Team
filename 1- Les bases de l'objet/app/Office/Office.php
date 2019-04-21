<?php
namespace App\Office;

use Core\Hydrate;

class Office
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $networkPlugs;

    /**
     * @var integer
     */
    private $electricPlugs;

    /**
     * @var integer
     */
    private $phonePlugs;

    /**
     * @var integer
     */
    private $chairs;

    /**
     * @var integer
     */
    private $desks;

    /**
     * @var integer
     */
    private $workers = 0;

    use Hydrate;

    /**
     * @return int
     * Space rate of the office
     */
    public function freeSpaceRate() :int
    {
        return
            ($this->getWorkers()-$this->getNetworkPlugs())  +
            ($this->getWorkers()-$this->getElectricPlugs()) +
            ($this->getWorkers()-$this->getPhonePlugs())    +
            ($this->getWorkers()-$this->getChairs())        +
            ($this->getWorkers()-$this->getDesks());
    }

    /**
     * True if no more worker can be added
     * @return bool
     */
    public function isFull()
    {
        return $this->freeSpaceRate() >= 0;
    }

    public function state()
    {
        return "
            <p style='float: left; margin-right: 1rem'>
                <strong>{$this->getName()}</strong><br/>
                Free space rate: {$this->freeSpaceRate()}
            </p>
        ";
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    protected function getNetworkPlugs(): int
    {
        return $this->networkPlugs;
    }

    /**
     * @param int $networkPlugs
     */
    protected function setNetworkPlugs(int $networkPlugs)
    {
        $this->networkPlugs = $networkPlugs;
    }

    /**
     * @return int
     */
    protected function getElectricPlugs(): int
    {
        return $this->electricPlugs;
    }

    /**
     * @param int $electricPlugs
     */
    protected function setElectricPlugs(int $electricPlugs)
    {
        $this->electricPlugs = $electricPlugs;
    }

    /**
     * @return int
     */
    protected function getPhonePlugs(): int
    {
        return $this->phonePlugs;
    }

    /**
     * @param int $phonePlugs
     */
    protected function setPhonePlugs(int $phonePlugs)
    {
        $this->phonePlugs = $phonePlugs;
    }

    /**
     * @return int
     */
    protected function getChairs(): int
    {
        return $this->chairs;
    }

    /**
     * @param int $chairs
     */
    protected function setChairs(int $chairs)
    {
        $this->chairs = $chairs;
    }

    /**
     * @return int
     */
    protected function getDesks(): int
    {
        return $this->desks;
    }

    /**
     * @param int $desks
     */
    protected function setDesks(int $desks)
    {
        $this->desks = $desks;
    }

    /**
     * @return int
     */
    public function getWorkers(): int
    {
        return $this->workers;
    }

    /**
     * @param int $workers
     */
    public function setWorkers(int $workers)
    {
        $this->workers = $workers;
    }
}
