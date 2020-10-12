<?php
// $res = 3434;
// $array = array();
// echo '1. is_array()'. is_array($array);
// echo is_array($res);
// $string  ="This is a way for exploding the string into array()";
// echo $string;
// $new_array =  explode(' ', $string);
// echo "<pre>".'2. explode(delimiter, string)';
// print_r($new_array);
// echo "</pre>";

// $new_string = implode(' ', $new_array);
// echo "3. implode(glue, pieces) \n ".$new_string;
// echo "<br />";
// $keywords = preg_split("/[\s,]+/", "hypertext language, programming");
// print_r($keywords);
// function destroy_foo() 
// {
//     global $foo;
//     unset($foo);
// }

// $foo = 'bar';
// destroy_foo();
// echo $foo;
// $array_with_key = array('First' =>44,'second' =>88);
// print_r(array_change_key_case ($array_with_key,CASE_LOWER ));
// $input_array = array('a', 'b', 'c', 'd', 'e');
// echo "<pre>";
// print_r(array_chunk($input_array, 2));
// echo "</pre>";
// echo "<pre>";
// print_r(array_chunk($input_array, 2, true));	
// echo "</pre>";
// $records = array(
//     array(
//         'id' => 2135,
//         'first_name' => 'John',
//         'last_name' => 'Doe',
//     ),
//     array(
//         'id' => 3245,
//         'first_name' => 'Sally',
//         'last_name' => 'Smith',
//     ),
//     array(
//         'id' => 5342,
//         'first_name' => 'Jane',
//         'last_name' => 'Jones',
//     ),
//     array(
//         'id' => 5623,
//         'first_name' => 'Peter',
//         'last_name' => 'Doe',
//     )
// );
 
// $first_names = array_column($records, 'last_name','id');
// echo "<pre>";
// print_r($first_names);
// echo "</pre>";
// $a = array('green', 'red', 'yellow');
// $b = array('avocado', 'apple', 'banana');
// $c = array_combine($a, $b);
// echo "<pre>";
// print_r($c);
// echo "</pre>";
// $array = array(1, "hello", 1, "world", "hello","world","Nice");
// $result =array_count_values($array);
// echo "<pre>";
// print_r($result);
// echo "</pre>";
 $fruits = array ("apple", "orange", array ("pear", "mango"),
    "banana");
    echo (count($fruits, 1));


?>