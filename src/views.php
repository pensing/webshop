<?php

namespace Webshop;

class TableView {

    public function showTable($stmt, $fields, $table) {

    //    echo "<table class='datatable'>";
    //    foreach ($rows as $row) {
    //         echo "<tr><td>" . $row['name'] . "</td><td>" . $row['price'] . "</td></tr>";
    //    }       
    //    echo "</table>";

    echo '<div class="table-container">';

    echo '
    <table class="table" style="width: auto; margin: auto;">
    <thead>
        <tr>';

        foreach($fields as $f => $f_value) {
            echo '<th scope="col">'.$f_value.'</th>';
        }

        // <th scope="col">'.$fields["id"].'</th>
        // <th scope="col">'.$fields["title"].'</th>
        // <th scope="col">'.$fields["create_date"].'</th>
    
    echo '
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';


    while ($row = $stmt->fetch()) {
        echo '<tr>';

        foreach($fields as $f => $f_value) {
            echo '<td>' . $row[$f]. '</td>';
        }

        //echo '<td>' . $row["id"]. '</td><td>' . $row["title"]. '</td><td>' . $row["create_date"]. '</td>';

        echo '<td><a href="'.$table.'_upd.php?id=' . $row["id"] . '"><i class="fas fa-pencil-alt" style="color:black; font-size:16px"></i></a></td>';
        echo '<td><a href="'.$table.'_del.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
        echo '</tr>';
    }

    echo '
    </tbody>
    </table>';

    echo '</div>';

    }

}

?> 