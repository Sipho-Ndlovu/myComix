<?php

require_once 'src/Comic.php';

class ComicsModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getCollection(array $filter = [])
{
    $whereClause = " `comics`.`archived` = 0 ";
    if (!empty($filter['filter_field']) && !empty($filter['filter_value'])) {
        // Assuming 'filter_field' and 'filter_value' are the keys in the $filter array
        $filterField = $filter['filter_field'];
        $filterValue = $filter['filter_value'];

        if ($filterField === 'name') {
            $whereClause .= " AND `comics`.`name` LIKE :filterValue ";
        } elseif ($filterField === 'author') {
            $whereClause .= " AND `authors`.`name` LIKE :filterValue ";
        } elseif ($filterField === 'publisher') {
            $whereClause .= " AND `publishers`.`name` LIKE :filterValue ";
        } elseif ($filterField === 'illustrator') {
            $whereClause .= " AND `illustrators`.`name` LIKE :filterValue ";
        } elseif ($filterField === 'genre') {
            $whereClause .= " AND `genres`.`name` LIKE :filterValue ";
        } elseif ($filterField === 'release_year') {
            $whereClause .= " AND `comics`.`release_year` LIKE :filterValue ";
        }
    }

    $sql = "SELECT 
        `authors`.`name` AS 'author', `publishers`.`name` AS 'publisher',
        `illustrators`.`name` AS 'illustrator', `genres`.`name` AS 'genre',
        `comics`.`id`, `comics`.`name`, `comics`.`archived`, `comics`.`image`, 
        `comics`.`condition`, `comics`.`release_year`
    FROM `comics`
        INNER JOIN `authors` ON `comics`.`author_id` = `authors`.`id`
        INNER JOIN `publishers` ON `comics`.`publisher_id` = `publishers`.`id`
        INNER JOIN `illustrators` ON `comics`.`illustrator_id` = `illustrators`.`id`
        INNER JOIN `genres` ON `comics`.`genre_id` = `genres`.`id`
    WHERE $whereClause";

    $query = $this->db->prepare($sql);

    // Bind the value with a wildcard for a LIKE search
    if (!empty($filter['filter_field']) && !empty($filter['filter_value'])) {
        $query->bindValue(':filterValue', "$filterValue%");
    }

    $query->execute();
    $comics = $query->fetchAll(PDO::FETCH_ASSOC);

    // Rest of the code...

  $comicObjs = [];
  foreach ($comics as $comic) {
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
