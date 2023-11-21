<?php

require_once 'src/Comic.php';

class ComicViewHelper
{
    public static function displayAllComics(array $comics): string
    {
        $output = '';
        $table = "<table>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Author</th>
                        <th>Illustrator</th>
                        <th>Publisher</th>
                        <th>Release Year</th>
                        <th>Condition Grade</th>
                    </tr>";

        foreach ($comics as $comic) {
            $output.= "<tr>";
            $output .= "<td><img src='$comic->image'></td>";
            $output .= "<td>$comic->name</td>";
            $output .= "<td>$comic->genre</td>";
            $output .= "<td>$comic->author</td>";
            $output .= "<td>$comic->illustrator</td>";
            $output .= "<td>$comic->publisher</td>";
            $output .= "<td>$comic->release_year</td>";
            $output .= "<td>$comic->condition</td>";
            $output .= "</tr>";
        }
        return "$table $output </table>";
    }
}
?>