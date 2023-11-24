<?php

require_once 'src/Comic.php';

class ComicsModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCollection()
    {
        $query = $this->db->prepare("SELECT 
        `authors`.`name` AS 'author', `publishers`.`name` AS 'publisher',
        `illustrators`.`name` AS 'illustrator', `genres`.`name` AS 'genre',
        `comics`.`id`, `comics`.`name`, `comics`.`archived`, `comics`.`image`, 
        `comics`.`condition`, `comics`.`release_year`
        
        FROM `comics`
            INNER JOIN `authors`
                ON `comics`.`author_id` = `authors`.`id`
                
            INNER JOIN `publishers`
                ON `comics`.`publisher_id` = `publishers`.`id`
                
            INNER JOIN `illustrators`
                ON `comics`.`illustrator_id` = `illustrators`.`id`
                
            INNER JOIN `genres`
                ON `comics`.`genre_id` = `genres`.`id`
        
        WHERE `comics`.`archived` = 0 ");
            
        $query->execute();
        $comics = $query->fetchAll();

        $comicObjs = [];

        foreach($comics as $comic) {
            $comicObjs[] = new Comic(
                $comic['id'],
                $comic['publisher'],
                $comic['name'],
                $comic['archived'],
                $comic['illustrator'],
                $comic['author'],
                $comic['genre'],
                $comic['release_year'],
                $comic['condition'],
                $comic['image']
            );
        }
        return $comicObjs;
    }

    public function getArchive()
    {
        $query = $this->db->prepare("SELECT 
        `authors`.`name` AS 'author', `publishers`.`name` AS 'publisher',
        `illustrators`.`name` AS 'illustrator', `genres`.`name` AS 'genre',
        `comics`.`id`, `comics`.`name`, `comics`.`archived`, `comics`.`image`, 
        `comics`.`condition`, `comics`.`release_year`
        
        FROM `comics`
            INNER JOIN `authors`
                ON `comics`.`author_id` = `authors`.`id`
                
            INNER JOIN `publishers`
                ON `comics`.`publisher_id` = `publishers`.`id`
                
            INNER JOIN `illustrators`
                ON `comics`.`illustrator_id` = `illustrators`.`id`
                
            INNER JOIN `genres`
                ON `comics`.`genre_id` = `genres`.`id`
        
        WHERE `comics`.`archived` = 1 ");
            
        $query->execute();
        $comics = $query->fetchAll();

        $comicObjs = [];

        foreach($comics as $comic) {
            $comicObjs[] = new Comic(
                $comic['id'],
                $comic['publisher'],
                $comic['name'],
                $comic['archived'],
                $comic['illustrator'],
                $comic['author'],
                $comic['genre'],
                $comic['release_year'],
                $comic['condition'],
                $comic['image']
            );
        }
        return $comicObjs;
    }
}

?>
