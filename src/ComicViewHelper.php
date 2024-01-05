<?php

require_once 'src/Comic.php';

class ComicViewHelper
{
    public static function displayArchive(array $comics): string
    {
        
        $output = '';
        $table = "<main class='table'>
                    <section class='tableHeader'>
                        <h1>My Archive</h1>
                     </section>
                    <section class='tableBody'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Author</th>
                                    <th>Illustrator</th>
                                    <th>Publisher</th>
                                    <th>Release Year</th>
                                    <th>Condition Grade</th>
                                    <th class='buttonField'></th>
                                </tr>
                            </thead>
                            <tbody>";

        foreach ($comics as $comic) {

            $output .= "<tr>";
            $output .= "<td><img class='cover' src='$comic->image'></td>";
            $output .= "<td>$comic->name</td>";
            $output .= "<td>$comic->genre</td>";
            $output .= "<td>$comic->author</td>";
            $output .= "<td>$comic->illustrator</td>";
            $output .= "<td>$comic->publisher</td>";
            $output .= "<td>$comic->release_year</td>";
            $output .= "<td>$comic->condition</td>";
            $output .= "<td class='btnColumn'>";
            $output .= "<form action='archiveComic.php?comic_id=$comic->id"; 
            $output .= isset($comic->name) ? "&name=" . urlencode($comic->name) : "";
            $output .= "&archived=" . urldecode(1);
            $output .= "' method='POST'>
                                <button class='btnCol' type='submit'>Restore</button>
                            </form>
                        </td>";
            $output .= "</tr>";
        }
        return "$table $output </tbody></table></section></main>";
    }

    public static function displayCollection(array $comics): string
    {
        $output = '';
        $table = "<main class='table'>
                    <section class='tableHeader'>
                        <h1>My Collection</h1>
                    </section>
                    <section class='tableBody'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Author</th>
                                    <th>Illustrator</th>
                                    <th>Publisher</th>
                                    <th>Release Year</th>
                                    <th>Condition Grade</th>
                                    <th class='buttonField'></th>
                                </tr>
                            </thead>
                            <tbody>";

        foreach ($comics as $comic) {
            $output .= "<tr>";
            $output .= "<td><img class='cover' src='$comic->image'></td>";
            $output .= "<td>$comic->name</td>";
            $output .= "<td>$comic->genre</td>";
            $output .= "<td>$comic->author</td>";
            $output .= "<td>$comic->illustrator</td>";
            $output .= "<td>$comic->publisher</td>";
            $output .= "<td>$comic->release_year</td>";
            $output .= "<td>$comic->condition</td>";
            $output .= "<td class='btnColumn'>
                            <form action='editComic.php?comic_id=$comic->id";
            $output .= isset($comic->name) ? "&name=" . urlencode($comic->name) : "";
            $output .= isset($comic->genre) ? "&genre=" . urlencode($comic->genre) : "";
            $output .= isset($comic->author) ? "&author=" . urlencode($comic->author) : "";
            $output .= isset($comic->illustrator) ? "&illustrator=" . urlencode($comic->illustrator) : "";
            $output .= isset($comic->publisher) ? "&publisher=" . urlencode($comic->publisher) : "";
            $output .= isset($comic->release_year) ? "&release_year=" . urlencode($comic->release_year) : "";
            $output .= isset($comic->condition) ? "&condition=" . urlencode($comic->condition) : "";
            $output .= "' method='POST'>
                                <button class='btnEdit' type='submit'>Edit Comic</button>
                            </form>";
            $output .= "<form action='archiveComic.php?comic_id=$comic->id"; 
            $output .= isset($comic->name) ? "&name=" . urlencode($comic->name) : "";
            $output .= "&archived=" . urldecode(0);
            $output .= "' method='POST'>
                                <button class='btnArchive' type='submit'>Archive</button>
                            </form>
                        </td>";
            $output .= "</tr>";
        }

        return "$table $output </tbody></table></section></main>";
    }
}
?>