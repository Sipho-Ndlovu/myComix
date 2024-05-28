<?php
require_once 'src/ComicModel.php';
require_once 'src/ComicViewHelper.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$db = new PDO('mysql:host=host.docker.internal;port=3306;dbname=mycomixdb', 'root', 'Koolkat2001!');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$filter = [];

if (isset($_GET['filter_field']) && isset($_GET['filter_value']) && isset($_GET['sort'])) {
    $filter = [
    'filter_field' => $_GET['filter_field'],
    'filter_value' => $_GET['filter_value'],
    'sort' => $_GET['sort']
    ];
}

$comicsModel = new ComicsModel($db);

$comics = $comicsModel->getCollection($filter);

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
        <link rel="stylesheet" href="style/form.css">
        <link rel="stylesheet" href="style/toolbar.css">
        <link rel="stylesheet" href="style/image.css">


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
                    <p class="title"><a href="collection.php">MyComix</a></p>
                </div>

                <i class="fa fa-bars" aria-hidden="true"></i>

                <ul>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <li><a href="collection.php">My Collection</a></li>
                    <li><a href="archive.php">My Archive</a></li>
                    <li><a href="#">My Profile</a></li>
                </ul>
            </nav>

            <div class="toolbar">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <select name="sort">
                        <option value="">-- Sort By --</option>
                        <option value="name">Title (ASC)</option>
                        <option value="name_DESC">Title (DESC)</option>
                        <option value="author">Author (ASC)</option>
                        <option value="author_DESC">Author (DESC)</option>
                        <option value="genre">Genre (ASC)</option>
                        <option value="genre_DESC">Genre (DESC)</option>
                        <option value="condition">Condition (ASC)</option>
                        <option value="condition_DESC">Condition (DESC)</option>
                    </select>
                    <select name="filter_field">
                        <option value="">-- Filter By --</option>
                        <option value="name">Title</option>
                        <option value="author">Author</option>
                        <option value="genre">Genre</option>
                        <option value="publisher">Publisher</option>
                        <option value="illustrator">Illustrator</option>   
                        <option value="release_year">Release Year</option>
                    </select>
                    <input type="text" name="filter_value" placeholder="Search">
                    <button type="submit">Filter & Sort</button>
                 </form>
                <button class="btnAdd">Add Comic</button>
            </div>

            <?php // We can now use our ViewHelper to display the products
            // Because the methods in the ViewHelper are static, we do not need to instantiate
            // a ViewHelper object
            echo ComicViewHelper::displayCollection($comics);
            ?>
        </div>

        <div class="coverContainer">
            <div class="coverClose">&times;</div>
            <img class="coverImage" src="" alt="">
        </div>

        <div class="formContainer">
            <div class="formClose">&times;</div>
            <form class="form" method="POST" action="src/addForm.php">
                <span>Add Comic</span>
                <input type="text" name="Book Title" id="title" placeholder="Book Title" />
                <input type="text" name="Author" id="author" placeholder="Author" />
                <input type="text" name="Illustrator" id="illustrator" placeholder="Illustrator" />
                <input type="text" name="Genre" id="genre" placeholder="Genre" />
                <input type="text" name="Publisher" id="publisher" placeholder="Publisher" />
                <input type="text" name="Release_Year" id="release_year" placeholder="Release Year" />
                <input type="text" name="Condition" id="condition" placeholder="condition" />
                <input type="text" name="Image_Link" id="image" placeholder="Image Link" />
                <input type="submit" value="Add Comic">
            </form>
        </div>

        <div class="footer">
               &copy; Siphosenkosi Ndlovu 2024
            </div>
        </div>
        <script src="src/addForm.js"></script>
        <script src="src/navbar.js"></script>
        <script src="src/image.js"></script>
    </body>
</html>