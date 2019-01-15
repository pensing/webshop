
<?php
    require_once("template.php");
    require_once("functions.php");
    ?>

<?php
    echo printHeader();
?>

<?php
// Check connection
/*if (connected()) {
    echo "Connected successfully";   
} else { die("Connection failed"); }*/

$servername = "localhost";
$username = "root";
$password = "paulus";
$dbname = "beleef";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


?>

<div class="container-fluid text-center pt-4" style="height:100%;" id="">
<h2 class="display-3 text-white font-weight-bold pt-2 pb-4" style="display:inline;">NIEUWS</h2>
</div>

<div class="" style="margin: auto;">
<table class="table table-sm table-light" style="width: auto; margin: auto;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Text</th>
    </tr>
  </thead>
  <tbody>

  <?php

$sql = "SELECT id, title, tekst FROM news";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    // output data of each row
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td><td>" . $row["title"]. "</td><td>" . $row["tekst"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

  ?>

</tbody>
</table>
</div>

<?php
    echo printFooter();
    mysqli_close($conn);
?>
