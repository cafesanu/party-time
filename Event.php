<?php  
/**
  * Class representing an event
  *
  * Class representing any type of event
  */
class Event {

    /**
      * Time when the event starts
      */
    protected $_start_time;

    /**
      * Time when the event ends
      */
    protected $_end_time;

    /**
      * Titile of the event
      */
    protected $_title;

    /**
      * Description of the event
      */
    protected $_description;

    /**
      * Unique id of the event
      */
    protected $_id;

    /**
      * Given a date, check if it's a weekend
      * Based on http://stackoverflow.com/questions/4802335/checking-if-date-is-weekend-php
      *
      * @param DateTime $date Date to be checked.
      *
      * @return bool True if date is Sat or Sun. False otherwise.
      */
    private function is_weekend($date){

        if (phpversion() >= 5.1){
            return (date('N', $date->getTimestamp()) >= 6);
        }
        else{
            $weekDay = date('w', $date->getTimestamp());
            return ($weekDay == 0 || $weekDay == 6);
        }
    }

    /**
      * Event constructor.
      *
      * @param  title Title of the event
      */
    public function __construct($title) 
    {
        $this->_id = uniqid();
        $this->_title = $title;
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
            if($property == '_start_time' || $property == '_end_time'){
                return $this->$property->format('Y-m-d H:i:s');
            }
            else{
                return $this->$property;
            }
        }
    }

    /**
      * Magic setter
      *
      * @param string $property Name of the property to be set.
      * @param mixed  $value    Value of the property to be set.
      *
      * @throws <b>Exception</b> If property is _start_time or _end_time and $value cannot be converted
      *         to DateTime
      *
      */
    public function __set($property, $value){
        if (property_exists($this, $property)) {
            if($property == '_start_time'){
                $this->$property = new DateTime($value);
            }
            elseif($property == '_end_time'){
                $this->$property = new DateTime($value);
                if($this->_end_time <= $this->_start_time){
                    throw new Exception('invalid date');
                }
            }
            else{
                $this->$property = $value;
            }
        }
    }

    public function __toString(){
        return '<ul>'.
                   '<li>Event Internal id: '.$this->_id.'</li>'.
                   '<li>Title: '.$this->_title.'</li>'.
                   '<li>Description: '.$this->_description.'</li>'.
                   '<li>Start Time: '.$this->_start_time->format('Y-m-d H:i:s').'</li>'.
                   '<li>End Time: '.$this->_end_time->format('Y-m-d H:i:s').'</li>';
    }

    /**
      * Check if any of the days between start_date and end_date is a weekend
      *
      * Based on http://php.net/manual/en/class.dateperiod.php#109846
      *
      *
      * @return bool True if any date between start and end date is Sat or Sun. False otherwise.
      */
    public function on_weekend() {
        $begin = $this->_start_time;
        $end = $this->_end_time;

        //Add one day in each loop iteration
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);

        //This for loos is going to iterate maximum 6 times.
        //Worst case scenario is that start date is a monday and then it has to loop until it gets
        //a Saturday
        foreach($daterange as $date){
            if($this->is_weekend($date)){
                return TRUE;
            }
        }
        //If no weekend was found
        return FALSE;
    }

}

?>