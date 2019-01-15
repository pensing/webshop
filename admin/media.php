<?php
require_once("header.php");
require_once("functions.php");
?>

<header>
	<h1 class="page-title mt-5" style="text-align:center; color: white; font-family: 'arial'; font-size: 48px;">MEDIA</h1>
</header>

<div class="table-container">
<table class="table" style="width: auto; margin: auto;">
  <thead>
    <tr>
      <th scope="col">Bestand</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

<?php
$d = dir("uploads");
//echo "Handle: " . $d->handle . "\n";
//echo "Path: " . $d->path . "\n";
while (false !== ($entry = $d->read())) {
    if ($entry<>'.'&& $entry<>'..') {
    echo '<tr>';
    echo '<td>'.$entry.'</td>';
    echo '<td><a href="media_upd.php?file_name=' . $entry . '"><i class="fas fa-pencil-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '<td><a href="media_del.php?file_name=' . $entry . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '</tr>';
    }
}
$d->close();
?>

</tbody>
</table>
</div>

<?php
require_once("footer.php");
?>
