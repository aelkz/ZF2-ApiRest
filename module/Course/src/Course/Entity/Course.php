<?php

namespace Course\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Entity(repositoryClass="Course\Entity\Repository\CourseRepository")
 * @ORM\Table(name="course")
 * @ORM\HasLifecycleCallbacks
 */
 class Course
 {
     /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description;

    /**
     *
     * @var \Datetime
     *
     *@ORM\Column(name="dateInsert", type="datetime", nullable=false)
     *
     */
    protected $dateInsert;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="dateUpdate", type="datetime",nullable=true)
     */
    protected $dateUpdate;

    /**
     * Get Id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return ORM\Entity
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Description
     *
     * @param string $description
     * @return ORM\Entity
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateInsert
     *
     * @param \DateTime
     * @return ORM\Entity
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }

    /**
     * Get dateInsert
     *
     * @return \DateTime
     */
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * Set dateUpdate
     *
     * @param \DateTime
     * @return ORM\Entity
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setDateUpdate(new \Datetime());
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setDateInsert(new \Datetime());
    }
}
