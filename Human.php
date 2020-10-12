<?php 
class Human {
	protected $genders = array('Male','Female','Others');
	protected function getFeatures($gender) {
		if($gender == "Male" ) {
			 echo "Men will be Men";
		} else if($gender == "Female") {
			 echo "Women's mind is a maze.";
		} else if ($gender == 'Others') {
			 echo "All are born equal.";
		}
	}
}
class Male extends Human {
	protected $gender = "Male";

	public function getMaleFeatures() {
		$this->getFeatures($this->gender);
	}

}
$human = new Human();
$male = new Male();

//echo $human->genders;
//$human->getFeatures("Male");
//echo $male->gender;
$male->getMaleFeatures();

?>