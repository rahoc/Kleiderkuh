<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Share test</title>
</head>

<body>


<?php
include 'head.php';

$title=urlencode('Kleider Kuh');
$url=urlencode('http://www.kleiderkuh.de');
$summary=urlencode('Just found the awesome website Kleider Kuhe were I can sell my kids cloth!');
$image=urlencode('http://www.kleiderkuh.de/images/Kuh_puzzle_logo.png');
?>
<br />
<br />
<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">Share your Kleider Kuh experience... <img src="images/fb.png" class="footimage"/></a>

</body>
</html>