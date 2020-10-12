<?php 
// class Person {
// 	private $fname;
// 	private $lname;
// 	public static $name;
// 	public static function geetName() {
// 		return self::$name;
// 	}
// 	public function setFName($new_fname) {
// 		$this->fname = $new_fname;
// 	}
// 	public function getFName() {
// 		return $this->fname;
// 	}
// 	public function setLName($new_lname) {
// 		$this->lname = $new_lname;
// 	}
// 	public function getLName() {
// 		return $this->lname;
// 	}
// }
// $john = new Person();
// // $john->fname ="John";
// // $john->lname ="Lames";
// $john->setFName("John");
// $john->setLName("Wick");
// echo "Object Name is ".$john->getFName();

?>
<?php
    class Person {
        // first name of person
        private $fname;
        // last name of person
        private $lname;
        
        // Constructor
        public function __construct($fname, $lname) {
            echo "Initialising the object...<br/>"; 
            $this->fname = $fname;
            $this->lname = $lname;
        }
        
        // Destructor
        public function __destruct(){
            // clean up resources or do something else
            echo "Destroying Object...";
        }
        
        // public method to show name
        public function showName() {
            echo "My name is: " . $this->fname . " " . $this->lname . "<br/>"; 
        }
    }
    
    // creating class object
    $john = new Person("John", "Wick");
    $john->showName();
    
?>