<?php
require_once("header.php");
?>

	<div id="primary" class="content-area">
		<header>
			<h1 class="page-title mt-5" style="text-align:center; color: white; font-family: 'arial'; font-size: 48px;">UPLOADEN</h1>
		</header>
    </div>


<?php
$target_dir = "uploads/";
//$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo $target_file;
$uploadOk = 1;
$melding = "";
$foutmelding = "";
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $melding = "Het bestand is een image - " . $check["mime"] . ". ";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $foutmelding =  "Het bestand is geen image. ";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, het bestand bestaat al.";
    $foutmelding = $foutmelding . "Sorry, het bestand bestaat al. ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    //echo "Sorry, je bestand is te groot.";
    $foutmelding = $foutmelding . "Sorry, je bestand is te groot. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
    $foutmelding = $foutmelding . "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan. ";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, je bestand is niet geupload.";
    $foutmelding = $foutmelding . "Sorry, je bestand is niet geupload. ";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geupload.";
        $melding = "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geupload.";
    } else {
        //echo "Sorry, het uploaden is fout gegaan.";
        $foutmelding = $foutmelding . "Sorry, het uploaden is fout gegaan.";
    }
}
}

?>


    <div class="table-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    
    <?php
    if ($melding <> "") {
        echo '<span class="melding">' . $melding . '</span><br /><br />';
    }
    if ($foutmelding <> "") {
        echo '<span class="foutmelding">' . $foutmelding . '</span><br /><br />';
    }
    ?>

    Kies een bestand om te uploaden:<br />
    <input type="file" name="fileToUpload" id="fileToUpload"><br /><br /><br />
    <input type="submit" value="Uploaden" name="submit">
    </form>
    </div>


<?php
require_once("footer.php");
 ?>
