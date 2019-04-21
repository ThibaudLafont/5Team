<?php
namespace App\Entity;

use Core\Entity\Entity;

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
    public function setId(int $id)
    {
        $this->id = $id;
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
        return $this->getDate()->format('d/m/Y');
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        if(is_string($date)) {
            $this->date = date_create_from_format('d/m/Y', $date);
        } else {
            $this->date = $date;
        }
    }
}