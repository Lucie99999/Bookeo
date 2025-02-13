<?php

namespace App\entity;

class Book
{
    protected ?int $id = null;

    protected string $title;
    protected int $authorId;
    protected string $description;
    protected int $categoryId;
    protected string $image;

    public function __construct(string $title, int $authorId,
                                string $description, int $categoryId, string $image)
    {
        $this->title = $title;
        $this->authorId = $authorId;
        $this->description = $description;
        $this->categoryId = $categoryId;
        $this->image = $image;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function setAuthorId(string $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


}