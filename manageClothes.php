<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="script.js"></script>


</head>
<body>
<?php
// LOGIN
if (isset($_POST['user']) && isset($_POST['pw'])) {
	if ($_POST['user'] == 'kleiderkuh' && $_POST['pw'] == '22qmuh22' ){
		$_SESSION['loggedIn'] = 'kleiderkuh';
	}
}
if (isset($_GET['logout'])) {
	if ($_GET['logout'] == 'true' ){
		$_SESSION['loggedIn'] = '';
	}
}
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'kleiderkuh') {
	echo "logged in as kleiderkuh <a href='manageTransactions2.php?logout=true'>logout</a><br />";
}
else {
	die( "not logged in: username and/or password wrong or you just logged out<br />
		<a href='login.php'>login</a>" );
}
// END LOGIN
?>
<?php
 //include 'head.php';
 
    
?>
<form action='manageClothes.php' method='post'>

<div id="editToolbar">
	<h2>Manage Clothes</h2>
     <a href="manageTransactions2.php">Manage Transactions</a><br />
   
<?php
        $brandFilter = "";
	$typeFilter = "";
	$sizeFilter ="";
        $genderFilter = "";
	if (isset($_POST["genderFilter"])) {
            $genderFilter = $_POST["genderFilter"];
        }
        if (isset($_POST["brandFilter"])) {
            $brandFilter = $_POST["brandFilter"];
        }
        if (isset($_POST["typeFilter"])) {
            $typeFilter = $_POST["typeFilter"];
        }
        if (isset($_POST["$sizeFilter"])) {
            $$sizeFilter = $_POST["$sizeFilter"];
        }
	
	
    echo "<label>Filter Gender:</label>
    <input id='genderFilter' type='text' name='genderFilter' value='$genderFilter' size='10' />
    <label>Filter Brand:</label>
    <input id='brandFilter' type='text' name='brandFilter' value='$brandFilter' size='10' />
    <label>Filter Type:</label>
    <input id='typeFilter' type='text' name='typeFilter' value='$typeFilter' size='10' />
    <label>Filter Size:</label>
    <input id='sizeFilter' type='text' name='sizeFilter' value='$sizeFilter' size='10' />";
    
?>
   
    <input id="filterButton" type='submit' value='Filter!' />
	
    </form>
    
    <form>
    <label>Actual Amount:</label>
    <input type='text' id='multiEditAct' value='' size='10' />
    <label>Max Amount:</label>
    <input type='text' id='multiEditMax' value='' size='10' />
    <label>Price:</label>
    <input type='text' id='multiEditPrice' value='' size='10' />

    <input type='button' onclick='doMultiEdit()' value='Set values for all checked Rows!' />
    </form>
    
 <br />
	<form action='manageClothes.php' method='post'>
    <input id='saveButton' type='submit' value='Save!' />
</div>


<div id="editContent">
    <img id="loaderImage" src="images/loader.gif" />
        
    <?php
    include 'db.php';
	
    
	if(isset($_POST['orderBy'])) {
            $orderBy = $_POST['orderBy'];
	} else {
		$orderBy = "gender, brand, type, size";
	}
	
//	if(isset($_GET['where'])) {
//          $where = $_GET['where'];
//	} else {
//		$where = "WHERE Brand LIKE Benetton";
//	}

	/*
	
	
	$mysqli = connectDB();
	
	// UPDATE IF NEEDED
	
	$countUpdates = 0;
	
	$abfrageIds = "SELECT id FROM Clothes";
	$ergebnisIds = $mysqli->query($abfrageIds);
	while($row = $ergebnisIds->fetch_object())
	{
		$changed = $_POST["changed$row->id"];
		if($changed==1) {
		
			$actA =	$_POST["actualAmount$row->id"];
			$maxA =	$_POST["maxAmount$row->id"];
			$pric =	$_POST["price$row->id"];
			$acti =	$_POST["active$row->id"];
			
			
			if($acti!=1) $acti=0;
			/*echo "UPDATE Clothes
						SET ActualAmount=$actA,
							MaxAmount=$maxA,
							Price=$pric,
							Active=$acti
						WHERE id=$row->id
						 <br />";
			$update = "	UPDATE Clothes
						SET ActualAmount=$actA,
							MaxAmount=$maxA,
							Price=$pric,
							Active=$acti
						WHERE id=$row->id
						
						";
						
			$mysqli->query($update);
			$countUpdates = $countUpdates + 1;
		} //end if($changed==1)
	} // end while
	
	
	
	
	//#####################################################################
	// OUTPUT DATA
	if($countUpdates > 0) {
		echo "You updated " . $countUpdates . " Clothes."; 
	}
        
        */
	
	
	
    
    ?>
    <div id='messages'></div>
    <div id="clothList"></div>

</form>
</div>
<br />
<?php
 //include 'foot.php';
?>
    <script src="manageClothes.js"></script>
    <script>
        showClothList("", "", "", "");
    </script>
</body>

</html>