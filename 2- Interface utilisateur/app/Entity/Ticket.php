<?php
namespace App\Entity;

use Core\Entity\Entity;
use Core\Service\IsDate;

class Ticket extends Entity
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var float
     */
    private $spent;

    /**
     * @var \DateTime
     */
    private $date;

    use IsDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        if($id !== '')
            $this->id = (int)$id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getSpent()
    {
        return $this->spent;
    }

    /**
     * @param float $spent
     */
    public function setSpent($spent)
    {
        $this->spent = $spent;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function getFormattedDate()
    {
        if($this->isFrenchDate($this->getDate())){
            return $this->getDate()->format('d/m/Y');
        } else {
            return $this->getDate();
        }
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        if($this->isFrenchDate($date)) {
            $this->date = date_create_from_format('d/m/Y', $date);
        } else {
            $this->date = $date;
        }
    }
}