<?php

namespace App\Entity;

use App\Entity\Member;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 */
class Admin extends Member
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $level;

    public function __construct(int $si, string $f, string $l, int $a, string $e, int $lvl)
    {
        parent::__construct($si, $f, $l, $e, $a);
        $this->level = $lvl;
    }


    /**
     * Get the value of level
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * Set the value of level
     *
     * @return  self
     */
    public function setLevel($level): self
    {
        $this->level = $level;

        return $this;
    }
}
