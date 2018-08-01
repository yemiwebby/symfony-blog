<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;


    /**
     * @ORM\Column(name="short_bio", type="string", length=500, nullable=true)
     */
    private $shortBio;

    /**
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;


    /**
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;


    /**
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(name="github", type="string", length=255, nullable=true)
     */
    private $github;



    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getShortBio(): ?string
    {
        return $this->shortBio;
    }

    public function setShortBio(?string $shortBio): self
    {
        $this->shortBio = $shortBio;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }
}
