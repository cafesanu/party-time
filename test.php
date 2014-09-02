<?php

require 'Person.php';
require 'Party.php';
/** Sample test run **/

$dade = new Person('Zero Cool');

$kate = new Person('Acid Burn');

$emmanuel = new Person('Cereal Killer');

$paul = new Person('Lord Nikon');

$ramon = new Person('Phantom Phreak');

$hackathon = new Party('Hackathon');

$hackathon->_description = "Hack the Planet!";

$hackathon->_start_time = "9/28/2012 2PM";

$hackathon->_end_time = "10/1/2012 5PM";

$hackathon->_address = "87 E 42nd St, New York, NY";

$hackathon->_host = $dade;

$hackathon->add_attendee($kate);

$hackathon->add_attendee($emmanuel);

$hackathon->add_attendee($ramon);

if ($hackathon->on_weekend()) {

 print "<h1>$hackathon->_title</h1>\n";

  print "<p>Starts {$hackathon->_start_time} and ends {$hackathon->_end_time}</p>\n";

  print "<p>There are {$hackathon->number_attending()} people attending the party</p>\n";

  print "<p>The event has an internal id of {$hackathon->_id}</p>\n";

  print "<p>$paul ";

  print $hackathon->is_attending($paul) ? 'is' : 'is not';

  print " attending the event</p>\n";

  print "<p>$kate ";

  print $hackathon->is_attending($kate) ? 'is' : 'is not';

  print " attending the event</p>\n";

  print "<p>You can get a map to the event <a href='{$hackathon->get_map_link()}'>Here</a></p>\n";

  print "<p>This party is being hosted by {$hackathon->_host} (user id is {$hackathon->_host->_id})</p>\n";

 } 
 else {
 	print "<p>{$hackathon} isn't on the weekend, who would want to go!</p>\n";
 }