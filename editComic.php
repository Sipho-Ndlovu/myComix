<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $book_id = $_GET['comic_id'];
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


    $query = $db->prepare("UPDATE `comics` SET `name` = :Book_Title WHERE `id` = :id");
    $query->bindParam(':Book_Title', $book_title);
    $query->bindParam(':id', $book_id);
    $query->execute();

    $query = $db->prepare("UPDATE `authors` SET `name` = :author WHERE `id` = (
        SELECT `author_id` FROM `comics` WHERE `id` = :id
    )");
    $query->bindParam(':author', $author);
    $query->bindParam(':id', $book_id);
    $query->execute();

    $query = $db->prepare("UPDATE `illustrators` SET `name` = :illustrator WHERE `id` = (
        SELECT `illustrator_id` FROM `comics` WHERE `id` = :id
    )");
    $query->bindParam(':illustrator', $illustrator);
    $query->bindParam(':id', $book_id);
    $query->execute();

    $query = $db->prepare("UPDATE `genres` SET `name` = :genre WHERE id = (
        SELECT `genre_id` FROM `comics` WHERE `id` = :id
    )");
    $query->bindParam(':genre', $genre);
    $query->bindParam(':id', $book_id);
    $query->execute();

    $query = $db->prepare("UPDATE `publishers` SET `name` = :publisher WHERE `id` = (
        SELECT `publisher_id` FROM `comics` WHERE `id` = :id
    )");
    $query->bindParam(':publisher', $publisher);
    $query->bindParam(':id', $book_id);
    $query->execute();

    $query = $db->prepare("UPDATE `comics` SET `release_year` = :release_year WHERE `id` = :id");
    $query->bindParam(':release_year', $release_year);
    $query->bindParam(':id', $book_id);
    $query->execute();

    $query = $db->prepare("UPDATE `comics` SET `condition` = :condition WHERE `id` = :id");
    $query->bindParam(':condition', $condition);
    $query->bindParam(':id', $book_id);
    $query->execute();
    $conditionColumn = $query->fetch();

    if (!$image == null) {
        $query = $db->prepare("UPDATE `comics` SET `image` = :image WHERE `id` = :id");
    $query->bindParam(':image', $image);
    $query->bindParam(':id', $book_id);
    $query->execute();
    }

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyComix | Edit Comic</title>

    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/editForm.css">

</head>
    <body>
        <div class='blur'></div>
        <div class="editFormContainer">
            <div class="formClose">&times;</div>
            <form class="form" method="POST" >
                <span>Edit Comic</span>
                <input type="text" name="Book_Title" id="title" placeholder="Book Title" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" />
                <input type="text" name="Author" id="author" placeholder="Author" value="<?php echo isset($_GET['author']) ? $_GET['author'] : ''; ?>" />
                <input type="text" name="Illustrator" id="illustrator" placeholder="Illustrator" value="<?php echo isset($_GET['illustrator']) ? $_GET['illustrator'] : ''; ?>" />
                <input type="text" name="Genre" id="genre" placeholder="Genre" value="<?php echo isset($_GET['genre']) ? $_GET['genre'] : ''; ?>"/>
                <input type="text" name="Publisher" id="publisher" placeholder="Publisher" value="<?php echo isset($_GET['publisher']) ? $_GET['publisher'] : ''; ?>" />
                <input type="text" name="Release_Year" id="release_year" placeholder="Release Year" value="<?php echo isset($_GET['release_year']) ? $_GET['release_year'] : ''; ?>" />
                <input type="text" name="Condition" id="condition" placeholder="Condition" value="<?php echo isset($_GET['condition']) ? $_GET['condition'] : ''; ?>" />
                <input type="text" name="Image" id="image" placeholder="Image Link" />
                <input type="submit" name="submit" value="Edit Comic">
            </form>
    </div>
    <script src="src/form.js"></script>
    </body>
</html>
