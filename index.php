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
        <title>MyComix | My Collection</title>

        <link rel="stylesheet" href="style/common.css">
        <link rel="stylesheet" href="style/table.css">
        <link rel="stylesheet" href="style/navbar.css">

        <link 
                rel="stylesheet" 
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
                integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
                crossorigin="anonymous" 
                referrerpolicy="no-referrer" 
            />

    </head>
    <body>

        <div>
            <nav>
                <div class="logo">
                    <p class="title"><a href="index.php">MyComix</a></p>
                </div>

                <i class="fa fa-bars" aria-hidden="true"></i>

                <ul>
                    <li><a href="index.php">My Collection</a></li>
                    <li><a href="archive.php">My Archive</a></li>
                </ul>
            </nav>

            <?php // We can now use our ViewHelper to display the products
            // Because the methods in the ViewHelper are static, we do not need to instantiate
            // a ViewHelper object
            echo ComicViewHelper::displayAllComics($comics);
            ?>
            <section>
                <div class="formClose">&times;</div>
                    <div class="circle">
                        <span class="registerHeading"></span>
                        <span class="registerBody"></span>
                    </div>
                </div>
            </section>

            <div class="footer">
               &copy; Siphosenkosi Ndlovu 2023
            </div>
        </div>
    </body>
</html>