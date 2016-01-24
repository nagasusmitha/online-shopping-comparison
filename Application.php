<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>online shopping comparison</title> 
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<style>
#one {

	 height:1000;
	width: 1000;
  float:center;
//background:blue;
	 border:groove;
}
#two {
		 width:1000;
	 height:1000;
	 float:center;
 //background:green;
	
}
</style>

</head>
<body>

<div id="wrapper">

	<!-- start header -->
		<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="img/vvit1.png"  /></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Home</a></li> 
						<li><a href="about.html">About</a></li>
						<li class="active"><a href="Application.php">Application</a></li>
                     
                    </ul>
                </div>
            </div>
        </div>
	</header><!-- end header -->
	<section id="inner-headline" class="bg-img">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Application</h2>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
		<div class="container content">		
        <!-- Service Blcoks -->
		<div class="row mar-b-50">
        
        <div class="col-lg-5 about wow fadeInRight animated" data-wow-animation-name="none" >
          <h3>
           Search 
          </h3>
          <p>
	



<div id="one">

<?php

require_once('ebay.php');
$ebay = new ebay('susmitha-33d6-4507-a108-4ef2bbbc500c', 'EBAY-IN');
$sort_orders = $ebay->sortOrders();
?>

<form action="Application.php"  method="post">
	<input type="text" name="search" id="search"  style="color:green " placeholder="search items">
	<select name="sort" id="sort">
	<?php
	foreach($sort_orders as $key => $sort_order){
	?>
		<option value="<?php echo $key; ?>"  style="background-color:#ccffff"><?php echo $sort_order; ?></option>
	<?php	
	}
	?>
	</select>
	<input type="submit" value="Search"  style="color:green">
</form>

<?php
if(!empty($_POST['search'])){
	$results = $ebay->findItemsAdvanced($_POST['search'], $_POST['sort']);
	$item_count = $results['findItemsAdvancedResponse'][0]['searchResult'][0]['@count'];
	
	if($item_count > 0){
		$items = $results['findItemsAdvancedResponse'][0]['searchResult'][0]['item'];
		?>
		<h1><img src="img/ebay.png" width="100" height="70"/> Results</h1>
		<table border="1" align="center" style="color:grey" target="one">
		<?php
		$count=0;
	$end = 1;
	
		foreach($items as $i){
			$count++;
	

$end = 0;
			if($count%3==1)
				echo '<tr><td align="center">';
			else if($count%3==2)
				echo '</td><td align="center">';
			else{
				echo '</td><td align="center">';
				$end =1;
			}
	?>

	
			<div class="item_title">
				<a href="<?php echo $i['viewItemURL'][0]; ?>"><?php echo $i['title'][0]; ?></a>
			</div>
			<div class="item_img">
				<img src="<?php echo $i['galleryURL'][0]; ?>" alt="<?php echo $i['title']; ?>">
			</div>
			<div class="item_price">
				<?php echo $i['sellingStatus'][0]['currentPrice'][0]['@currencyId']; ?>
				<?php echo $i['sellingStatus'][0]['currentPrice'][0]['__value__']; ?>
			</div>
			
			
<?php
		}
		?>
		</table>
		<?php
	}
if($item_count ==0)
{
?>
<h1 style="color:red" align="center">NO RESULT FOUND</h1>	
</div>
<?php
}
}
?><br>
<div id="two">

<?php
require_once('demo.php');
?>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script> 
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
</body>
</html>