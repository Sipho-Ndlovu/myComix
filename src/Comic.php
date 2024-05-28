<?php

readonly class Comic 
{
    public function __construct(
        public int $id,
        public ?string $publisher,
        public ?string $name,
        public int $archived,
        public ?string $illustrator,
        public ?string $author,
        public ?string $genre,
        public ?string $release_year,
        public ?float $condition,
        public ?string $image,
    ) {}
}
?>
