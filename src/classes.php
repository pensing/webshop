<?php
namespace Webshop;

class person {
    public $fName;
    public $lastName;
    public $birthDate;
    
    public function __construct($fname, $lname, $bdate) {
        $this->fName=$fname;
        $this->lastName=$lname;
        $this->birthDate=$bdate;
    }

    public function getFullname() {
        $fullName = ($this->fName . ' ' . $this->lastName);
        return "Volledige naam is:" . $fullName;
    }

    public function getAge() {
        //$Age = date('m-d-Y') - $birthDay;
        //date in mm-dd-yyyy format; or it can be in other formats as well
        //$birthDate = "21-05-1966";
        //explode the date to get month, day and year
        //$birthDate = explode("-", $birthDate);
        //$bDate = explode("-", $this->birthDate);
        //get age from date or birthdate
        // $age = (date("md", date("U", mktime(0, 0, 0, $bDate[0], $bDate[1], $bDate[2]))) > date("md")
        //      ? ((date("Y") - $bDate[2]) - 1)
        //      : (date("Y") - $bDate[2]));

        // $tz  = new DateTimeZone('Europe/Brussels');
        // $age = DateTime::createFromFormat('d-m-Y', $this->birthDate, $tz)
        //     ->diff(new DateTime('now', $tz))
        //     ->y;

        $age = floor((time() - strtotime($this->birthDate)) / 31556926);
        return "Leeftijd is:" . $age;
    }

    public function getBirthdate() {
        //$Age = date('m-d-Y') - $birthDay;
        //date in mm-dd-yyyy format; or it can be in other formats as well
        //$birthDate = "21-05-1966";
        //explode the date to get month, day and year
        //$birthDate = explode("-", $birthDate);
        //$bDate = explode("-", $this->birthDate);
        //get age from date or birthdate
        // $age = (date("md", date("U", mktime(0, 0, 0, $bDate[0], $bDate[1], $bDate[2]))) > date("md")
        //      ? ((date("Y") - $bDate[2]) - 1)
        //      : (date("Y") - $bDate[2]));

        // $tz  = new DateTimeZone('Europe/Brussels');
        // $age = DateTime::createFromFormat('d-m-Y', $this->birthDate, $tz)
        //     ->diff(new DateTime('now', $tz))
        //     ->y;

        return "Geboortedatum is:" . $this->birthDate;
    }
}

class user extends person {
    private $userRole;
    function __construct($uRole) {
        $this->userRole=$uRole;
    }
}

class customer extends person {
    private $registrationDate;
    function __construct($rDate) {
        $this->registrationDate=$rDate;
    }
}

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
        $content = '<div class="card-deck col-sm-4 pr-1 pl-1 pt-2">
        <div class="card">
          <img class="card-img-top" src="'.$this->filename.'" width="" alt="Generic placeholder image">

          <div class="card-body">
            <h4 class="mt-3 mb-1 text-dark">'.$this->name.'</h4>
            <span style="font-size: 48px; font-weight: bold; font-style: italic;">'.number_format($this->price, 0, ',', ' ').',-</span>
            <p>'.$this->description.'</p>
            <a href="product.php?id='.$this->id.'" class="btn btn-dark readbutton" role="button">Productinfo</a>
          </div>
        </div></div>';

        return $content;
    }

}

//}
?>