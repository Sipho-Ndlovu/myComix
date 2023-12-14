<?php
$class = "error";
$archived = isset($_GET['archived']) ? $_GET['archived'] : "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $db = new PDO('mysql:host=db; dbname=MyComixDB', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $book_id = $_GET['comic_id'];

    if ($archived == 0){
        $query = $db->prepare("UPDATE `comics` SET `archived` = 1 WHERE `id` = :id");
        $query->bindParam(':id', $book_id);
        $query->execute();
        header('Location: index.php');
        exit;
    }
    elseif ($archived == 1){
        $query = $db->prepare("UPDATE `comics` SET `archived` = 0 WHERE `id` = :id");
        $query->bindParam(':id', $book_id);
        $query->execute();
        header('Location: archive.php');
        exit;
    }
    else {
        $class = "errorShown";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyComix | <?php echo ($archived == 0) ? 'Archive ' : 'Restore ' ?> <?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?></title>

    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/archiveForm.css">
</head>
    <body>
        <div class='blur'></div>
        <div class="archiveFormContainer">
            <div class="formClose archiveColse">&times;</div>
            <form class="form" method="POST" >
                <div>
                    <span>
                        Are you sure you want to <?php echo ($archived == 0) ? 'archive ' : 'restore ' ?> 
                        <?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>?
                    </span>
                <div>
                <input type="submit" name="submit" value="<?php echo ($archived == 0) ? 'Archive ' : 'Restore ' ?> Comic">
                <span class="<?php echo $class; ?>">Error: <?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?> couldn't be 
                    <?php echo ($archived == 0) ? 'archived!' : (($archived == 1) ? 'restored!' : 'altered!'); ?>
                </span>
            </form>
        </div>
        <script src="src/form.js"></script>
    </body>
</html>