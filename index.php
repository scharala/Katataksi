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




<!doctype html>	
<html>
<head>
<title>Διαπιστωτική Πράξη Kατάταξης Eκπ/κών Σε Βαθμούς της ΔΙ.Π.Ε. Χανίων</title>

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
 background-image:url("old-town.jpg");	
width:100%;	
height:200%;	
 background-size:cover;	
 background-position:center;	
 padding-top:110px;	

}	



.center{
text-align:center;
}
label{
font-size:1.4em;
}

.white {
font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;	
/*color:white;	*/
}	
.owhite{
	/*color:white;*/
	font-family: Tahoma, Geneva, sans-serif;
}

.PrakseisForm {
border:1px solid grey;
 border-radius:10px;
 margin-bottom: 180px;
  background-color: white;
 /*margin-top: 0px;*/
 /*padding-top:50px;*/
}

.ft{
	/*color:#b7d1e5;*/
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



<form method="post" class="frm" accept-charset='UTF-8' >

<h1 class="center white">Διαπιστωτική Πράξη Κατάταξης Εκπ/κών της ΔΙ.Π.Ε. Χανίων Σε Βαθμούς </h1>
<h3>(μέχρι τις 01/01/2016, σύμφωνα με το Ν. 1566/1985)</h3>

<h3 class="center white">Εισάγετε τον Αριθμό Μητρώου και το Επώνυμό σας με Ελληνικούς χαρακτήρες</h3>
</br>

<div class="form-group">
<label for="name" class="owhite">ΑΜ:</label>
<input type="text" name="inputAfm" id="nm" class="form-control" placeholder="ΑΜ" value="<?php echo $_POST['inputAfm']; ?>" />
</div>

<div class="form-group">

<label for="surname" class="owhite">Επώνυμο:</label>
<input type="text" name="inputSurname" id="snm" class="form-control" placeholder="Επώνυμο" value="<?php echo $_POST['inputSurname']; ?>"/>

</div>



<input type="submit" name="submit" class="btn btn-success btn-lg" value="Υποβολή"" />

<?php echo $result; ?>

</form>

</div>
</div>

<h5 class=ft><strong> Webmaster Charalampakis Stergios </strong></h4>

</div>

 <!-- <script type="text/javascript">	
 
 $(".container").css("min-height",$(window).height());	
 


 </script>	 -->


</body>
</html>












