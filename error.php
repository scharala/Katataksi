<?php


session_start();
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
function SetSessionNull(){
	$_SESSION['inputAfm']=NULL;
  $_SESSION['inputSurname']=NULL;
}
$inputAfm=$_POST['inputAfm'];
$inputSurname=grstrtoupper($_POST['inputSurname']);
if ($_POST["submit"]) {
			
			
	 	 if (!$inputAfm) {
			 $error="Παρακαλώ πληκτρολογήστε το ΑΜ σας";

	 	 } elseif(strlen($inputAfm)!=6 || !is_numeric($inputAfm)){
			$error="Μη έγκυρος ΑΜ!!";	 	 	
	 	 }
			
	 	 if (!$inputSurname) {

			 $error.="<br/>Παρακαλώ πληκτρολογήστε το Επώνυμό σας";

	 	 }
			
	 	 
			
	 	 if ($error) {
	 	 	SetSessionNull();

			 $result='<div class="alert alert-danger"><strong>'.$error.'</div>';

	 	 } else {
	 	 	

			# include parseCSV class.
			require_once('parsecsv.lib.php');
			# create new parseCSV object.
			$csv = new parseCSV();
			# Parse '_books.csv' using automatic delimiter detection...
			$csv->encoding('iso8859-7','UTF-8');
			#if the first digit of $inputAfm is zero then it will be trimmed in the csv
			#this is a trick to bypass this
			// if($inputAfm.substr(0,1)=="0"){
			// 	$inputAfm=$inputAfm.substr(1);
			// }
			// echo $inputSurname;
			$csv->conditions = 'inputAfm is '.$inputAfm.' AND inputSurname is '.$inputSurname;
			$csv->auto('vathmoi.csv');
			$parsed = $csv->data;
			// echo $parsed[0];
			$inputAfm=$parsed[0][inputAfm];
			// if(strlen($inputAfm)<9){
			// 	$inputAfm=
			// }
			$inputSurname=$parsed[0][inputSurname];
			$vathmos=$parsed[0][vathmos];
			$pleonazon=$parsed[0][pleonazon];
			if($inputSurname==""){
				$result='<div class="alert alert-danger"> H/O συγκεκριμένος Εκπαιδευτικός δεν υπάρχει στην Βάση των Εκπαιδευτικών της ΔΙ.Π.Ε. Χανίων </div>';
			}else{
				// $_GET['logout']='0';
				$_SESSION['inputAfm']=$inputAfm;
				$_SESSION['inputSurname']=$inputSurname;
				 $result='<div class="alert alert-success">H/O Εκπαιδευτικός <strong>'.$inputSurname.' με ΑΜ: '.$inputAfm.'</strong>, κατατάσσεται  <strong>ΑΝΑΔΡΟΜΙΚΑ</strong> από <strong>1-1-2016</strong>  (ημερομηνία έναρξης ισχύος του Ν.4354) στο βαθμό  ν.1566/1985: <strong>'.$vathmos.' </strong>
				 <br/> με πλεονάζοντα χρόνο κατά την ημερομηνία αυτή: <strong>'.$pleonazon;
				 
			}

 	} 



 }

 




?>