<?php

namespace App\Entity;

class Post{
    private ?int $id;
    private string $title;
    private string $header;
    private string $content;
    private \DateTime $creationDate;
    private \DateTime $modificationDate;
    private string $thumbnail;

    /* GETTERS / SETTERS */

    /*
    *
    * ID
    *
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    /*
    *
    * TITLE
    *
    */

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /*
    *
    * HEADER
    *
    */

    public function getHeader(): string
    {
        return $this->header;
    }

    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    /*
    *
    * CONTENT
    *
    */

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /*
    *
    * CREATION DATE
    *
    */

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /*
    *
    * MODIFICATION DATE
    *
    */

    public function getModificationDate(): \DateTime
    {
        return $this->modificationDate;
    }

    public function setModificationDate(\DateTime $modificationDate): void
    {
        $this->modificationDate = $modificationDate;
    }

    /*
    *
    * THUMBNAIL
    *
    */

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

}