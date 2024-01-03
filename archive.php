<?php
require_once 'src/ComicModel.php';
require_once 'src/ComicViewHelper.php';
$db = new PDO('mysql:host=host.docker.internal;port=3306;dbname=mycomixdb', 'root', 'Koolkat2001!');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$comicsModel = new ComicsModel($db);

$comics = $comicsModel ->getArchive();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyComix | My Archive</title>

        <link rel="stylesheet" href="style/common.css">
        <link rel="stylesheet" href="style/table.css">
        <link rel="stylesheet" href="style/navbar.css">
        <link rel="stylesheet" href="style/form.css">


        <link 
                rel="stylesheet" 
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
                integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
                crossorigin="anonymous" 
                referrerpolicy="no-referrer" 
            />

    </head>
    <body>

        <div class = "page">
            <nav>
                <div class="logo">
                    <p class="title"><a href="index.php">MyComix</a></p>
                </div>

                <i class="fa fa-bars" aria-hidden="true"></i>

                <ul>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <li><a href="index.php">My Collection</a></li>
                    <li><a href="archive.php">My Archive</a></li>
                    <li><a href="#">My Profile</a></li>
                </ul>
            </nav>

            <?php // We can now use our ViewHelper to display the products
            // Because the methods in the ViewHelper are static, we do not need to instantiate
            // a ViewHelper object
            echo ComicViewHelper::displayArchive($comics);
            ?>
        </div>

        <div class="footer">
               &copy; Siphosenkosi Ndlovu 2023
            </div>
        </div>
        <script src="src/addForm.js"></script>
        <script src="src/navbar.js"></script>
    </body>
</html>