<?php
require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="">BERICHTEN</h1>
</header>

<?php

try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<span class="melding">Verbinding is gelukt</span><br /><br />';
    $sql = "SELECT id, title, create_date FROM news";
    //$sql = "SELECT a.id, a.title, b.name as cat, c.name, a.create_date FROM news a 
    //JOIN news_categories b ON a.categorie_id=b.id INNER JOIN news_editors c ON a.editor_id=c.id
    //ORDER BY a.id";
    //$stmt = $conn->prepare($sql); 
    //$stmt->execute();
    $stmt = $conn->query($sql);
}
catch(PDOException $e) {
    echo foutMelding($e->getMessage());
}

?>

<div class="table-container">
<table class="table" style="width: auto; margin: auto;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titel</th>
      <th scope="col">Datum</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = $stmt->fetch()) {
    echo '<tr>';
    echo '<td>' . $row["id"]. '</td><td>' . $row["title"]. '</td><td>' . $row["create_date"]. '</td>';
    echo '<td><a href="news_upd.php?id=' . $row["id"] . '"><i class="fas fa-pencil-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '<td><a href="news_del.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '</tr>';
}

  ?>

</tbody>
</table>
</div>


<?php
    //echo printFooter();
    $conn = null;
?>

<?php
require_once("footer.php");
?>
