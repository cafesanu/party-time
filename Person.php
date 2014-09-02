<?php  

/**
  * Class representing a person
  *
  * Class representing a person with a name and unique id.
  */
class Person {

    /**
      * Unique id of person
      */
    protected $_id;

    /**
      * Name of person
      */
    protected $_name;

    /**
      * Person constructor.
      *
      * @param  name Name of person
      *
      * @throws <b>Exception</b> If name contains characters differents than alphabetical characters
      */
    public function __construct($name) 
    {
        $this->_id = uniqid();

        //Calling set method to catch exception in both constructor and set without having to repeat code
        $this->__set('_name', $name);
    }

    /**
      * Magic getter
      *
      * @param  string $property Name of the property to get.
      *
      * @return mixed Value of the property.
      */
    public function __get($property){
        if( property_exists( $this, $property ) ){
            return $this->$property;
        }
    }

    /**
      * Magic setter
      *
      * @param string $property Name of the property to be set.
      * @param mixed  $value    Value of the property to be set.
      *
      * @throws <b>Exception</b> If property is _name and characters differents than alphabetical characters
      *
      * @return mixed Value of the property.
      */
    public function __set($property, $value){
        if (property_exists($this, $property)) {

            if($property == '_name'){

                if( !is_string( $value )  || !preg_match("/^[a-zA-Z ]+$/", $value) == 1){
                    throw new Exception('non-alphabetic');
                }
            }

            $this->$property = $value;
        }

    }

    /**
      * Magic toString
      *
      * @return String name of the person.
      */
    public function __toString(){
        return $this->_name;
    }
}

?>
