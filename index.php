<?php
require_once 'src/ComicModel.php';
require_once 'src/ComicViewHelper.php';
$db = new PDO('mysql:host=db; dbname=myComixDB', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$comicsModel = new ComicsModel($db);

$comics = $comicsModel ->getAllComics();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyComix</title>
</head>
<body>
<div>
<?php // We can now use our ViewHelper to display the products
// Because the methods in the ViewHelper are static, we do not need to instantiate
// a ViewHelper object
echo ComicViewHelper::displayAllComics($comics);
?>
</div>
</body>
</html>