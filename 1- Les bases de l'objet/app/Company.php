<?php
namespace App;

use App\Office\CommercialOffice;
use App\Office\DeveloperOffice;
use Core\Hydrate;

class Company
{
    /**
     * @var array
     */
    private $commercialOffices;

    /**
     * @var array
     */
    private $developerOffices;

    /**
     * @var array
     */
    private $offices;

    use Hydrate;

    public function hire()
    {
        // Display initial Company state
        echo $this->state();

        // Get all offices
        $offices = $this->getOffices();

        // Do while company is not full
        do {
            // While dev offices not all full, random choose of worker type (dev/commercial)
            if(rand(0,1) == 1 && !empty($offices['dev'])) {
                $this->hireWorker('dev', $offices);
            // When dev offices are full, only hire Commercial workers
            } else {
                $this->hireWorker('com', $offices);
            }
        } while ($this->freeSpaceRate() < 0);
    }

    public function hireWorker($type, $offices) {
        // Loop on every office and hire as soon as a not full office is find
        foreach ($offices[$type] as $k=>$office) {
            // If office can hire new worker
            if(!$office->isFull()) {
                // Add one worker to office
                $office->setWorkers(
                    $office->getWorkers()+1
                );
                echo $this->state();
                break;
                // If office is full, remove it from offices to avoid useless loop
            } else {
                unset($offices[$type][$k]);
            }
        }
    }

    public function state()
    {
        // Company state
        $return = "
            <div style='overflow: auto;>'<p>
                <strong>Company</strong><br/>
                Number of developers: {$this->nbreOfDevelopers()}<br/>
                Number of commercials: {$this->nbreOfCommercials()}<br/>
                Free space rate: {$this->freeSpaceRate()}
            </p>
        ";

        // Add every Commercial offices state
        foreach ($this->getCommercialOffices() as $office) {
            $return .= $office->state();
        }

        // Add every Developer offices state
        foreach ($this->getDeveloperOffices() as $office) {
            $return .= $office->state();
        }

        // Add <hr> for lisibility and return
        $return .= '<hr style="clear: both"></div>';
        return $return;
    }

    /**
     * Loop on every Developers offices in order to calculate numbre of workers
     *
     * @return int
     */
    public function nbreOfDevelopers()
    {
        $nbre = 0;
        foreach ($this->getDeveloperOffices() as $office) {
            $nbre += $office->getWorkers();
        }
        return $nbre;
    }

    /**
     * Loop on every Commercial offices in order to calculate number of workers
     *
     * @return int
     */
    public function nbreOfCommercials()
    {
        $nbre = 0;
        foreach ($this->getCommercialOffices() as $office) {
            $nbre += $office->getWorkers();
        }
        return $nbre;
    }

    /**
     * Loop on every offices in order to calculate Company free space rate
     *
     * @return int
     */
    public function freeSpaceRate()
    {
        $rate = 0;
        foreach($this->getDeveloperOffices() as $office) {
            $rate += $office->freeSpaceRate();
        }
        foreach($this->getCommercialOffices() as $office) {
            $rate += $office->freeSpaceRate();
        }
        return $rate;
    }

    /**
     * @return array
     */
    public function getCommercialOffices(): array
    {
        return $this->commercialOffices;
    }

    /**
     * @param array $commercialOffices
     */
    public function setCommercialOffices(array $commercialOffices)
    {
        $this->commercialOffices = [];
        foreach ($commercialOffices as $office) {
            $this->addCommercialOffice($office);
        }
    }

    /**
     * @param CommercialOffice $commercialOffice
     * @internal param array $commercialOffices
     */
    public function addCommercialOffice(CommercialOffice $commercialOffice)
    {
        $this->commercialOffices[] = $commercialOffice;
    }

    /**
     * @return array
     */
    public function getDeveloperOffices(): array
    {
        return $this->developerOffices;
    }

    /**
     * @param array $developerOffices
     */
    public function setDeveloperOffices(array $developerOffices)
    {
        $this->developerOffices = [];
        foreach($developerOffices as $office) {
            $this->addDeveloperOffice($office);
        }
    }

    /**
     * @param DeveloperOffice $developerOffice
     * @internal param CommercialOffice|DeveloperOffice $commercialOffice
     * @internal param array $commercialOffices
     */
    public function addDeveloperOffice(DeveloperOffice $developerOffice)
    {
        $this->developerOffices[] = $developerOffice;
    }

    /**
     * Return all offices in type sorted array
     *
     * @return array
     */
    public function getOffices(): array
    {
        if(is_null($this->offices)){
            $this->setOffices([
                'dev' => $this->getDeveloperOffices(),
                'com' => $this->getCommercialOffices()
            ]);
        }
        return $this->offices;
    }

    /**
     * @param array $offices
     */
    public function setOffices(array $offices)
    {
        $this->offices = $offices;
    }

}
