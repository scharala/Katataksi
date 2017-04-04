<?php
session_start();
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_GET['logout']=='1') {
	$_SESSION['inputAfm']=NULL;
  $_SESSION['inputSurname']=NULL;
 
}

include("error.php");



?>

<?php

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

function grstrtoupper($string) {
		$latin_check = '/[\x{0030}-\x{007f}]/u';
		if (preg_match($latin_check, $string))
		{
			$string = strtoupper($string);
		}
		$letters  								= array('α', 'β', 'γ', 'δ', 'ε', 'ζ', 'η', 'θ', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ', 'ο', 'π', 'ρ', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ', 'ω');
		$letters_accent 						= array('ά', 'έ', 'ή', 'ί', 'ό', 'ύ', 'ώ');
		$letters_upper_accent 					= array('Ά', 'Έ', 'Ή', 'Ί', 'Ό', 'Ύ', 'Ώ');
		$letters_upper_solvents 				= array('ϊ', 'ϋ');
		$letters_other 							= array('ς');
		$letters_to_uppercase					= array('Α', 'Β', 'Γ', 'Δ', 'Ε', 'Ζ', 'Η', 'Θ', 'Ι', 'Κ', 'Λ', 'Μ', 'Ν', 'Ξ', 'Ο', 'Π', 'Ρ', 'Σ', 'Τ', 'Υ', 'Φ', 'Χ', 'Ψ', 'Ω');
		$letters_accent_to_uppercase 			= array('Α', 'Ε', 'Η', 'Ι', 'Ο', 'Υ', 'Ω');
		$letters_upper_accent_to_uppercase 		= array('Α', 'Ε', 'Η', 'Ι', 'Ο', 'Υ', 'Ω');
		$letters_upper_solvents_to_uppercase 	= array('Ι', 'Υ');
		$letters_other_to_uppercase 			= array('Σ');
		$lowercase = array_merge($letters, $letters_accent, $letters_upper_accent, $letters_upper_solvents, $letters_other);
		$uppercase = array_merge($letters_to_uppercase, $letters_accent_to_uppercase, $letters_upper_accent_to_uppercase, $letters_upper_solvents_to_uppercase, $letters_other_to_uppercase);
		$uppecase_string = str_replace($lowercase, $uppercase, $string);
		return $uppecase_string;
}

if ($_POST["submit"]) {

			
			
	 	 if (!$_POST['name']) {

			 $error="Παρακαλώ πληκτρολογήστε το Όνομά σας";

	 	 }
			
	 	 if (!$_POST['surname']) {

			 $error.="<br/>Παρακαλώ πληκτρολογήστε το Επώνυμό σας";

	 	 }
			
	 	 
			
	 	 if ($error) {

			 $result='<div class="alert alert-danger"><strong>'.$error.'</div>';

	 	 } else {
	 	 	$name=grstrtoupper($_POST['name']);
	 	 	$surname=grstrtoupper($_POST['surname']);

			# include parseCSV class.
			require_once('parsecsv.lib.php');
			# create new parseCSV object.
			$csv = new parseCSV();
			# Parse '_books.csv' using automatic delimiter detection...
			$csv->encoding('iso8859-7','UTF-8');
			$csv->conditions = 'surname is '.$surname.' AND name is '.$name;
			$csv->auto('PRAKSEIS_ESPA.csv');
			$parsed = $csv->data;
			$name=$parsed[0][name];
			$surname=$parsed[0][surname];
			$praksi=$parsed[0][praksi];
			if($name==""){
				$result='<div class="alert alert-danger"><strong> H/O <strong>'.grstrtoupper($_POST['surname']).' '.grstrtoupper($_POST['name']).' δεν υπάρχει στην Βάση των Αναπληρωτών Εκπαιδευτικών </div>';
			}else{

				 $result='<div class="alert alert-success">Η πράξη που ανήκει η/ο Εκπαιδευτικός <strong>'.$surname.' '.$name.'</strong>, είναι: <strong>'.$praksi.' </strong>
				 <br/> Μπορείτε να κατεβάσετε το παρουσιολόγιο της συγκεκριμένης πράξης <strong> <a href="parousiologia/'.$praksi.'.xls"> εδώ </a> </strong>
				 <br/> Οδηγίες συμπλήρωσης του παρουσιολογίου υπάρχουν <strong> <a href="parousiologia/odigies.doc"> εδώ </a> </strong> </div>';
			}

 	} 



 }

 




?>


<!doctype html>	
<html>
<head>
<title>Εξεύρεση Πράξης ΕΣΠΑ/ΠΔΕ Που Ανήκουν Οι Εκπαιδευτικοί</title>

<meta charset="utf-8" />	
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />	
 <meta name="viewport" content="width=device-width, initial-scale=1" />	
 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<style>

.container {	
 background-image:url("school.jpg");	
width:100%;	
height:200%;	
 background-size:cover;	
 background-position:center;	
 padding-top:150px;	
}	

.center{
text-align:center;
}
label{
font-size:1.4em;
}

.white {
font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;	
color:white;	
}	
.owhite{
	color:white;
	font-family: Tahoma, Geneva, sans-serif;
}

.PrakseisForm {
border:1px solid grey;
 border-radius:10px;
 margin-bottom: 180px;
 /*margin-top: 0px;*/
 /*padding-top:50px;*/
}

.ft{
	color:#b7d1e5;
	float: right;
	font-family: "Comic Sans MS", cursive, sans-serif;
}

.btn{
margin-bottom: 20px;
margin-top: 5px;
}
</style>

</head>

<body>


<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2 center PrakseisForm">



<form method="post" accept-charset='UTF-8' >

<h1 class="center white">Αναζήτηση πράξεων-έργων που ανήκουν οι Αναπληρωτές Εκπαιδευτικοί ΕΣΠΑ/ΠΔΕ</h1>

<h3 class="center white">Εισάγετε το Όνομα και το Επώνυμό σας με Ελληνικούς χαρακτήρες</h3>
</br>

<div class="form-group">
<label for="name" class="owhite">Όνομα:</label>
<input type="text" name="name" id="nm" class="form-control" placeholder="Όνομα" value="<?php echo $_POST['name']; ?>" />
</div>

<div class="form-group">

<label for="surname" class="owhite">Επώνυμο:</label>
<input type="text" name="surname" id="snm" class="form-control" placeholder="Επώνυμο" value="<?php echo $_POST['surname']; ?>"/>

</div>



<input type="submit" name="submit" class="btn btn-success btn-lg" value="Υποβολή"" />

<?php echo $result; ?>

</form>

</div>
</div>

<h5 class=ft> Webmaster Charalampakis Stergios </h4>

</div>

 <!-- <script type="text/javascript">	
 
 $(".container").css("min-height",$(window).height());	
 


 </script>	 -->


</body>
</html>












