<?php

class product {

    private $id;
    private $name;
    private $description;
    private $categorie_id;
    private $sku;
    private $price;
    private $features;
    private $options;
    private $filename;

    //function __construct($pId, $pName, $pDescription, $pCategorie_id, $pSku, $pPrice, $pFeatures, $pOptions, $pFilename) {
    function __construct($r) {
        $this->id=$r["id"];
        $this->name=$r["name"] ;
        $this->description=$r["description"];
        $this->categorie_id=$r["categorie_id"];
        $this->sku=$r["sku"];
        $this->price=$r["price"];
        $this->features=$r["features"];
        $this->options=$r["options"];
        //$this->filename=$r["image_filename"];

        if (is_file('admin/uploads/'.$r["image_filename"])) {
            $this->filename='admin/uploads/'.$r["image_filename"];
        } else {
            $this->filename="images/default.jpg";
        }
    
        
    }

    public function printProductInfo() {
        $content = '
        <li class="media medialist">
          <img class="mr-3" src="'.$this->filename.'" width="350px" alt="Generic placeholder image">

          <div class="media-body">
            <h2 class="mt-3 mb-1 text-dark">'.$this->name.'</h2>
            <span style="font-size: 48px; font-weight: bold; font-style: italic;">'.number_format($this->price, 0, ',', ' ').',-</span>
            <p>'.$this->description.'</p>
            <a href="article.php?id='.$this->id.'" class="btn btn-dark readbutton" role="button">LEES VERDER</a>
          </div>
        </li>';

        return $content;
    }

}

?>

