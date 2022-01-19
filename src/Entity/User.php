<?php

namespace App\Entity;

use App\Entity\Member;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends Member
{


    /**
     * @ORM\Column(type="boolean")
     */
    private bool $personalDatas;

    public function __construct(string $f, string $l, string $e, int $a, bool $p, int $si)
    {
        parent::__construct($si, $f, $l, $e, $a);

        $this->personalDatas = $p;
    }

    /**
     * Get the value of personalDatas
     */
    public function getPersonalDatas(): bool
    {
        return $this->personalDatas;
    }

    /**
     * Set the value of personalDatas
     *
     * @return  self
     */
    public function setPersonalDatas($personalDatas): self
    {
        $this->personalDatas = $personalDatas;

        return $this;
    }

    public function getFullName(): string
    {
        $fullname = ucwords("$this->firstName $this->lastName") . " : " . $this->personalDatas;
        return $fullname;
    }
}
