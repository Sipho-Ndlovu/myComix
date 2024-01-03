<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_title = isset($_POST['Book_Title']) && $_POST['Book_Title'] !== '' ? $_POST['Book_Title'] : null;
    $author = isset($_POST['Author']) && $_POST['Author'] !== '' ? $_POST['Author'] : null;
    $illustrator = isset($_POST['Illustrator']) && $_POST['Illustrator'] !== '' ? $_POST['Illustrator'] : null;
    $genre = isset($_POST['Genre']) && $_POST['Genre'] !== '' ? $_POST['Genre'] : null;
    $publisher = isset($_POST['Publisher']) && $_POST['Publisher'] !== '' ? $_POST['Publisher'] : null;
    $release_year = isset($_POST['Release_Year']) && $_POST['Release_Year'] !== '' ? $_POST['Release_Year'] : null;
    $condition = isset($_POST['Condition']) && $_POST['Condition'] !== '' ? $_POST['Condition'] : null;
    $image = isset($_POST['Image']) && $_POST['Image'] !== '' ? $_POST['Image'] : null;

    $db = new PDO('mysql:host=host.docker.internal;port=3306;dbname=mycomixdb', 'root', 'Koolkat2001!');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    $query = $db->prepare('SELECT `id` FROM `authors` WHERE `name` = :author');
    $query->bindParam(':author', $author);
    $query->execute();
    $authorRow = $query->fetch();

    if ($authorRow) {
        $authorId = $authorRow['id'];
    } else {
        $query = $db->prepare('INSERT INTO `authors` (`name`) VALUES (:author)');
        $query->bindParam(':author', $author);
        $query->execute();
        $authorId = $db->lastInsertId();
    }

    $query = $db->prepare('SELECT `id` FROM `illustrators` WHERE `name` = :illustrator');
    $query->bindParam(':illustrator', $illustrator);
    $query->execute();
    $illustratorRow = $query->fetch();

    if ($illustratorRow) {
        $illustratorId = $illustratorRow['id'];
    } else {
        $query = $db->prepare('INSERT INTO `illustrators` (`name`) VALUES (:illustrator)');
        $query->bindParam(':illustrator', $illustrator);
        $query->execute();
        $illustratorId = $db->lastInsertId();
    }

    $query = $db->prepare('SELECT `id` FROM `genres` WHERE `name` = :genre');
    $query->bindParam(':genre', $genre);
    $query->execute();
    $genreRow = $query->fetch();

    if ($genreRow) {
        $genreId = $genreRow['id'];
    } else {
        $query = $db->prepare('INSERT INTO `genres` (`name`) VALUES (:genre)');
        $query->bindParam(':genre', $genre);
        $query->execute();
        $genreId = $db->lastInsertId();
    }

    $query = $db->prepare('SELECT `id` FROM `publishers` WHERE `name` = :publisher');
    $query->bindParam(':publisher', $publisher);
    $query->execute();
    $publisherRow = $query->fetch();

    if ($publisherRow) {
        $publisherId = $publisherRow['id'];
    } else {
        $query = $db->prepare('INSERT INTO `publishers` (`name`) VALUES (:publisher)');
        $query->bindParam(':publisher', $publisher);
        $query->execute();
        $publisherId = $db->lastInsertId();
    }

    $query = $db->prepare(
        'INSERT INTO `comics`
            (`publisher_id`, `name`, `illustrator_id`, `author_id`, `genre_id`,  `release_year`, `condition`, `image`)
            VALUES (:publisher_id, :Book_Title, :illustrator_id, :author_id, :genre_id, :release_year, :condition, :image)'
    );

    $query->bindParam(':publisher_id', $publisherId);
    $query->bindParam(':Book_Title', $book_title);
    $query->bindParam(':illustrator_id', $illustratorId);
    $query->bindParam(':author_id', $authorId);
    $query->bindParam(':genre_id', $genreId);
    $query->bindParam(':release_year', $release_year);
    $query->bindParam(':condition', $condition);
    $query->bindParam(':image', $image);
    $success = $query->execute();

    header('Location: ../index.php');
    exit;
}