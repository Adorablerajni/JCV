<?php 
// class Person{
// 	var $name;	
// 	function get_name() {
// 		return $this->name;
// 	}
// 	function set_name($new_name) {
// 		$this->name = $new_name;
// 	}

// }
class StudyTonight {
	var $url = "www.studytonight.com";
	function desc() {
		echo "Studytonight is platform to learn OOPs";
	}
}
$study_tonight =new StudyTonight();
echo $study_tonight->url ."<br />";
$study_tonight->desc();
?>