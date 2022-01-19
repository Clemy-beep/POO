<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name ="article",uniqueConstraints={@ORM\UniqueConstraint(name="title_content_constraint", columns={"title", "content"})})
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(type="string")
     */
    private string $title;
    /**
     * @ORM\Column(type="text")
     */
    private string $content;

    /** 
     * @ORM\ManyToOne(targetEntity="member",cascade={"persist"})
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * 
     */
    private Member $author;

    public function __construct(string $t, string $c, Member $a)
    {
        $this->title = $t;
        $this->content = $c;
        $this->author = $a;
    }



    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Get the value of author
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author): self
    {
        $this->author = $author;

        return $this;
    }
}
