<?php
    // abstract class
    abstract class Vehicle {
    
        // protected variable
        protected $name;
    
        // non-abstract public function start
        public function start() {
            echo $this->name. " - Engine start...<br/>";
        }
        
        // non-abstract public function stop
        public function stop() {
            echo $this->name. " - Engine stop...<br/>";
        }
        
        // non-abstract public function setName
        public function setName($name) {
            $this->name = $name;
        }
        
        // abstract function mileage
        abstract public function mileage() ;
    }
    class Car extends Vehicle {
        
        public function mileage() {
            echo "I am " . $this->name . "<br/>";
            echo "My mileage range is - 15 to 22 Km/L";
        }
        
    }
     class Motorcycle extends Vehicle {
        
        public function mileage() {
            echo "I am " . $this->name . "<br/>";
            echo "My mileage range is - 35 to 47 Km/L";
        }
        
    }
    // $vehicle= new Vehicle();
    $car = new Car();
    $car->setName("BMW X1");
    $car->mileage();
?>