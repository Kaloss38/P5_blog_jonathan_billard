<?php

class Comment{
    private ?int $id;
    private string $content;
    private \Datetime $creationDate;
    private bool $isValidated;

    public function __construct(){

    }

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

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }
    
    /*
    *
    * VALIDATED
    *
    */

    public function getIsValidated(): bool
    {
        return $this->isValidated;
    }

    public function setIsValidated($isValidated): void
    {
        $this->isValidated = $isValidated;
    }

}