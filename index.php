<?php
	//Default values
	$party_title = 'Hackathon';
	$description = '';
	$start_time = '9/3/2014 2PM';
	$end_time = '9/29/2014 2PM';
	$address = '87 E 42nd St, New York, NY';
	$host = 'Carlos Sanchez';
	$person1 = 'Ricky Ricardo';
	$person2 = 'Cosmo Kramer';
	$person3 = 'George Carlin';
	$p1_checked = 'checked';
	$p2_checked = '';
	$p3_checked = 'checked';

	//Preserve values sent by user
	if( count( $_POST ) > 0 ){
		if (array_key_exists('party_title', $_POST)) {
			if(empty($_POST['party_title'])){
				$required = 'Party title is required';
			}
			$party_title = $_POST['party_title'];
		}
		if (array_key_exists('description', $_POST)) {
			$description = $_POST['description'];
		}
		if (array_key_exists('start_time', $_POST)) {
			if(empty($_POST['start_time'])){
				$required = 'Start time is required';
			}
			$start_time = $_POST['start_time'];
		}
		if (array_key_exists('end_time', $_POST)) {
			if(empty($_POST['end_time'])){
				$required = 'End time is required';
			}
			$end_time = $_POST['end_time'];
		}
		if (array_key_exists('address', $_POST)) {
			if(empty($_POST['address'])){
				$required = 'Address is required';
			}
			$address = $_POST['address'];
		}
		if (array_key_exists('host', $_POST)) {
			$host = $_POST['host'];
		}
		if (array_key_exists('person1', $_POST)) {
			$person1 = $_POST['person1'];
		}
		if (array_key_exists('person2', $_POST)) {
			$person2 = $_POST['person2'];
		}
		if (array_key_exists('person3', $_POST)) {
			$person3 = $_POST['person3'];
		}
		if (array_key_exists('check_p1', $_POST)) {
			if($_POST['check_p1'] == 'true'){
				$p1_checked = 'checked';
			}
		}
		else{
			$p1_checked = '';
		}
		if (array_key_exists('check_p2', $_POST)) {
			if($_POST['check_p2'] == 'true'){
				$p2_checked = 'checked';
			}
			
		}
		else{
			$p2_checked = '';
		}
		if (array_key_exists('check_p3', $_POST)) {
			if($_POST['check_p3'] == 'true'){
				$p3_checked = 'checked';
			}
		}
		else{
			$p3_checked = '';
		}

	}
?>

<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/stylesheets/main.css">
		<title>
			Party Time!
		</title>
	</head>
	<body>
		<table >
			<tr>
				<td>
					<div class="form-container">
					<form method="post">
						<div class="form-title"><h2>Create party</h2></div>

						<div class="form-title">Party Title *</div>			
						<input class="form-field" type="text" name="party_title" value=<?php echo "\"".$party_title."\"" ?> />

						<div class="form-title">Party Description</div>
						<textarea class="form-field" rows="3" name="description" placeholder="Want to hack this page? put html code in any of these form fields!"><?php echo $description ?></textarea>

						<div class="form-title">Start Time *</div>			
						<input class="form-field" type="text" name="start_time" value=<?php echo "\"".$start_time."\"" ?> />

						<div class="form-title">End Time *</div>			
						<input class="form-field" type="text" name="end_time" value=<?php echo "\"".$end_time."\"" ?> />

						<div class="form-title">Address *</div>			
						<input class="form-field" type="text" name="address" value=<?php echo "\"".$address."\"" ?> />

						<div class="form-title">Host</div>			
						<input class="form-field" type="text" name="host" value=<?php echo "\"".$host."\"" ?>/>

						<div class="form-title">Person 1</div>			
						<input class="form-field" type="text" name="person1" value=<?php echo "\"".$person1."\"" ?>/>
						<input type="checkbox" name="check_p1" value="true" <?php echo $p1_checked ?> >Attending party?<br />

						<div class="form-title">Person 2</div>
						<input class="form-field" type="text" name="person2" value=<?php echo "\"".$person2."\"" ?>/>
						<input type="checkbox" name="check_p2" value="true" <?php echo $p2_checked ?>>Attending party?<br />

						<div class="form-title">Person 3</div>
						<input class="form-field" type="text" name="person3" value=<?php echo "\"".$person3."\"" ?> />
						<input type="checkbox" name="check_p3" value="true" <?php echo $p3_checked ?>>Attending party?<br />


						<div class="submit-container">
						<input class="submit-button" type="submit" value="Submit" />
					</form>
					</div>
				</td>
				<td>
					<?php
						require 'Person.php';
						require 'Party.php';
						if( count( $_POST ) > 0 ){

							print "<div class=\"form-container\">";
							if(!empty($required)){
								print '<h3>';
									print $required;
								print '</h3>';
							}
							else{
								try {									
									$party = New Party($party_title);
									$party->_description = $description;
									$party->_start_time = $start_time;
									$party->_end_time = $end_time;
									$party->_address = $address;
									$party_host = new Person($host);
									$party->_host = $party_host;
									if($party->on_weekend()){
										$not_attending = 'Not Attending<ul>';
										$person = new Person($person1);
										if (array_key_exists('check_p1', $_POST) and $_POST['check_p1'] == 'true') {
											$party->add_attendee($person);
											
										}
										else{
											$not_attending = $not_attending.'<li>'.$person.'</li>';
										}	
										$person = new Person($person2);
										if (array_key_exists('check_p2', $_POST) and $_POST['check_p2'] == 'true') {
											$party->add_attendee($person);
											
										}
										else{
											$not_attending = $not_attending.'<li>'.$person.'</li>';
										}	
										$person = new Person($person3);
										if (array_key_exists('check_p3', $_POST) and $_POST['check_p3'] == 'true') {
											$party->add_attendee($person);
											
										}
										else{
											$not_attending = $not_attending.'<li>'.$person.'</li>';
										}	
										$not_attending = $not_attending.'</ul>';

										print "<h1>Party time!</h1>\n";
										print "<img border=\"0\" src=\"/images/party_time.gif\" alt=\"Party time\">";
										print '<h3>';
										print $party;
										print '</h3><br>';

										print '<h3>';
										print $not_attending;
										print '</h3>';
									}
									else{
										print "<img border=\"0\" src=\"/images/facepalm.jpg\" alt=\"Party isn't on the weekend\">";
										print "<h1>Who would want to go!</h1>\n";
									}
								}
								catch (Exception $e) {
									$msg = $e->getMessage();
									if (strpos($msg,'DateTime') !== false) {
									    print '<h3>';
											print 'Please enter valid dates';
										print '</h3>';;
									}
									elseif ($msg == 'non-alphabetic') {
									    print '<h3>';
											print 'Robot names are invalid. Names are supposed to have only alphabet characters<br><br>';
											print "<img border=\"0\" src=\"/images/robots.jpg\" alt=\"Party isn't on the weekend\">";
										print '</h3>';
									}
									elseif ($msg == 'invalid date') {
									    print '<h3>';
											print 'End date must be greater that start date<br><br>';
											print "<img border=\"0\" src=\"/images/great_scott.jpg\" alt=\"End date must be greater that start date\">";
										print '</h3>';
									}
								}
							}
							print "</div>";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>