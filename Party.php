<?php
	require_once 'Person.php';
	require 'Event.php';

	/**
	  * Class representing aparty
	  *
	  * Class representing any type of party
	  */
	class Party extends Event {

	    /**
	      * Party's host
	      */
	    protected $_host;

	    /**
	      * Party's address
	      */
	    protected $_address;

	    /**
	      * Party's attendees
	      */
	    protected $_attendees;

	    /**
	      * Party constructor.
	      *
	      * @param  title Title of the event
	      */
	    public function __construct($title) 
	    {
	    	parent::__construct($title);
	    	$this->_attendees = array();
	    }

	    /**
	      * Given a person, checks is person is already in attendees list
	      *
	      * @param  person Person to check
	      */
	    public function is_attending(Person $person){
	    	foreach($this->_attendees as $attendee){
	    		if($attendee->_id == $person->_id){
	    			return TRUE;
	    		}
	    	}
    		//person not found in _attendees list
    		return FALSE;
	    }
	  	
	  	/**
	  	  *Generate google maps link based on address
	  	  */
	    public function get_map_link(){
	    	return 'https://www.google.com/maps/place/'.$this->_address;
	    }
	  
	    /**
	      * Adds a person to the list of attendees if person is not already in list
	      *
	      * @param  person Person to add
	      */
	    public function add_attendee(Person $person){
	    	//Verify is person is already in list. If not, add person
	    	if(!$this->is_attending($person)){
	    		array_push($this->_attendees, $person);
	    	}
	    }
	  
	  	/**
	  	  *Number of people attending to party
	  	  */
	    public function number_attending(){

	    	return count($this->_attendees);
	    }


	    public function __toString(){
	        $str = parent::__toString();
	        $str = $str.
	        	   '<li>Host: '.$this->_host.'</li>'.
	        	   '<li>Host id: '.$this->_host->_id.'</li>'.
	               '<li>Address: <a href="https://www.google.com/maps/place/'.$this->_address.'">'.$this->_address.'</a></li>'.
	               '<li>Attendees:</li>'.
	               '<ul>';
           	foreach($this->_attendees as $attendee){
	    		$str = $str.'<li>'.$attendee->_name.'</li>';
	    	}
	    	$str = $str.'</ul>';
	    	$str = $str.'</ul>';
	        return $str;
	    }
	}
?>