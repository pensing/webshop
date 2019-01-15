<?php
require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="">GEBRUIKERS</h1>
</header>

<?php

try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<span class="melding">Verbinding is gelukt</span><br /><br />';
    $sql = "SELECT id, user_name, password, email, display_name, register_date FROM users ORDER BY id";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    //$stmt = $conn->query($sql);
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
      <th scope="col">Email</th>
      <th scope="col">Schermnaam</th>
      <th scope="col">Geregistreerd</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = $stmt->fetch()) {
    $password = $row["password"];
    $password = "********";
    echo '<tr>';
    echo '<td>' . $row["id"]. '</td><td>' . $row["email"]. '</td><td>' . $row["display_name"]. '</td><td>' . $row["register_date"]. '</td>';
    echo '<td><a href="users_upd.php?id=' . $row["id"] . '"><i class="fas fa-pencil-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '<td><a href="users_del.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
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
