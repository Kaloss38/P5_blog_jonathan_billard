<?php

namespace App\Entity;
use Core\Entity;

class Comment extends Entity {
    private ?int $id;
    private string $content;
    private $creationDate;
    private bool $isValidated;
    private bool $isWaiting;
    private bool $isDisapproved;
    
    public function __construct(array $datas = [])
    {
        parent::__construct($datas);    
    }

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

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): void
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

    /*
    *
    * WAITING
    *
    */

    public function getIsWaiting(): bool
    {
        return $this->isWaiting;
    }

    public function setIsWaiting($isWaiting): void
    {
        $this->isWaiting = $isWaiting;
    }

    /*
    *
    * DISAPPROVED
    *
    */

    public function getIsDisapproved(): bool
    {
        return $this->isDisapproved;
    }

    public function setIsDisapproved($isDisapproved): void
    {
        $this->isDisapproved = $isDisapproved;
    }

}