<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<style>

.gender {
	background-color:#F00;
	height:100px;
	width:100px;
	transition-property: right;
    transition-duration: 1s;
    transition-timing-function: linear;
	position:absolute;
	right:50%;
	top:10px;
}
.brand {
	background-color:#00F;
	height:100px;
	width:100px;
	transition-property: right;
    transition-duration: 1s;
    transition-timing-function: linear;
	position:absolute;
	right:50%;
	top:10px;
}

.size {
	background-color:#0F0;
	height:100px;
	width:100px;
	transition-property: right;
    transition-duration: 1s;
    transition-timing-function: linear;
	position:absolute;
	right:50%;
	top:10px;
}

.type {
	background-color:#DDD;
	height:100px;
	width:100px;
	transition-property: right;
    transition-duration: 1s;
    transition-timing-function: linear;
	position:absolute;
	right:50%;
	top:10px;
}

.first {
	right:calc(50% + 150px);
}
.second {
	right:calc(50% + 300px);
}
.third {
	right:calc(50% + 450px);
}
</style>
</head>

<body>

<div class="brand">Brand</div>
<div class="gender">Gender</div>
<div class="type">Type</div>
<div class="size">Size</div>

<script>
$(document).ready(function(e) {
    $(".gender").hide(1);
	$(".type").hide(1);
	$(".size").hide(1);
});
$(".brand").click(function() {
	if($(".brand").hasClass("second") || $(".brand").hasClass("third")) {
		$(".brand").removeClass("third");
		$(".brand").removeClass("second");
		$(".gender").removeClass("second");	
		$(".gender").removeClass("first");	
		$(".type").removeClass("first");
		$(".type").hide(1);
		$(".size").hide(1);	
	}
	$(".brand").addClass("first");	
	$(".gender").show(100);	
});
$(".gender").click(function() {
	if($(".gender").hasClass("second") ) {
		$(".brand").removeClass("third");
		$(".brand").addClass("second");
		$(".gender").removeClass("second");	
		$(".type").removeClass("first");
		$(".size").hide(1);	
	}
	$(".brand").removeClass("first");	
	$(".brand").addClass("second");	
	$(".gender").addClass("first");	
	$(".type").show(100);		
});
$(".type").click(function() {
	$(".brand").removeClass("second");	
	$(".brand").addClass("third");
	$(".gender").removeClass("first");		
	$(".gender").addClass("second");
	$(".type").addClass("first");		
	$(".size").show(100);	
});

</script>


</body>
</html>