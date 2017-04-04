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
			 $error="Παρακαλώ πληκτρολογήστε το ΑΦΜ σας";

	 	 } elseif(strlen($inputAfm)!=9 || !is_numeric($inputAfm)){
			$error="Μη έγκυρος ΑΦΜ!!";	 	 	
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
			// echo $inputAfm;
			$csv->conditions = 'inputAfm is '.$inputAfm.' AND inputSurname is '.$inputSurname;
			$csv->auto('ESPA.csv');
			$parsed = $csv->data;
			$inputAfm=$parsed[0][inputAfm];
			// if(strlen($inputAfm)<9){
			// 	$inputAfm=
			// }
			$inputSurname=$parsed[0][inputSurname];
			$praksi=$parsed[0][praksi];
			if($inputSurname==""){
				$result='<div class="alert alert-danger"> H/O συγκεκριμένος Εκπαιδευτικός δεν υπάρχει στην Βάση των Αναπληρωτών Εκπαιδευτικών ΕΣΠΑ/ΠΔΕ </div>';
			}else{
				// $_GET['logout']='0';
				$_SESSION['inputAfm']=$inputAfm;
				$_SESSION['inputSurname']=$inputSurname;
				 $result='<div class="alert alert-success">Η πράξη που ανήκει η/ο Εκπαιδευτικός <strong>'.$inputSurname.' με ΑΦΜ '.$inputAfm.'</strong>, είναι: <strong>'.$praksi.' </strong>
				 <br/> Μπορείτε να κατεβάσετε το παρουσιολόγιο της συγκεκριμένης πράξης <strong> <a href="parousiologia/'.$praksi.'.xls"> εδώ </a> </strong>
				 <br/> Οδηγίες συμπλήρωσης του παρουσιολογίου υπάρχουν <strong> <a href="parousiologia/odigies.doc"> εδώ </a> </strong> 
				 <br/> Δείτε την μισθοδοσία σας <strong> <a href="http://www.dipechan.gr/espa-payments/index.php" target="_blank"> εδώ </strong> </a> </div>';
				 $logged='</ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://www.dipechan.gr/PortalESPA/PortalEspa.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Αποσυνδεθείτε</a></li>
      </ul>';
			}

 	} 



 }

 




?>