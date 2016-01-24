<?php
 error_reporting(0);
//@ FutureRulers
//Include the class.
include "flipkartapi.php";
if(isset($_POST['search']))
{
$search=$_POST['search'];
$search=str_replace(" ", "+", $search);
//Replace <affiliate-id> and <access-token> with the correct values
$flipkart = new \Futurerulers\Flipkart("manideept", "a5130251463440da8745d6215142a47e", "json");

//To view category pages, API URL is passed as query string.
$url ='https://affiliate-api.flipkart.net/affiliate/search/json?query='.
$url.=$search.'&resultCount=10';
if($url){
	//URL is base64 encoded to prevent errors in some server setups.


	//This parameter lets users allow out-of-stock items to be displayed.
	$hidden = isset($_GET['hidden'])?false:true;

	//Call the API using the URL.
	$details = $flipkart->call_url($url);

	if(!$details){
		echo 'Error: Could not retrieve products list.';
		exit();
	}

	//The response is expected to be JSON. Decode it into associative arrays.
	$details = json_decode($details, TRUE);

	//The response is expected to contain these values.
	$nextUrl = $details['nextUrl'];
	$validTill = $details['validTill'];
	$products = $details['productInfoList'];

		//Products table
		?>
		 <h1><img src="img/flipkart.png" width="100" height="50"/>Results</h1>
		<table border="1" align="center" style="color:grey" target="two">
		 <?php
		$count = 0;
		$end = 1;

	//Make sure there are products in the list.
	if(count($products) > 0){
		foreach ($products as $product) {

			//Hide out-of-stock items unless requested.
			$inStock = $product['productBaseInfo']['productAttributes']['inStock'];
			if(!$inStock && $hidden)
				continue;
			
			//Keep count.
			$count++;
			$title = $product['productBaseInfo']['productAttributes']['title'];
		//	if($title=='/^American/')
				if (preg_match("//i", $title))
				
				{

			//The API returns these values nested inside the array.
			//Only image, price, url and title are used in this demo
			$productId = $product['productBaseInfo']['productIdentifier']['productId'];
			$title = $product['productBaseInfo']['productAttributes']['title'];
			$productDescription = $product['productBaseInfo']['productAttributes']['productDescription'];

			//We take the 200x200 image, there are other sizes too.
			$productImage = array_key_exists('200x200', $product['productBaseInfo']['productAttributes']['imageUrls'])?$product['productBaseInfo']['productAttributes']['imageUrls']['200x200']:'';
			$sellingPrice = $product['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
			$productUrl = $product['productBaseInfo']['productAttributes']['productUrl'];
			$productBrand = $product['productBaseInfo']['productAttributes']['productBrand'];
			$color = $product['productBaseInfo']['productAttributes']['color'];
			$productUrl = $product['productBaseInfo']['productAttributes']['productUrl'];

			//Setting up the table rows/columns for a 3x3 view.
			$end = 0;
			if($count%3==1)
				echo '<tr align="center"><td>';
			else if($count%3==2)
				echo '</td align="center"><td>';
			else{
				echo '</td align="center"><td>';
				$end =1;
			}

			echo '<a target="_blank" href="'.$productUrl.'"><img src="'.$productImage.'"/><br>'.$title."</a><br>Rs. ".$sellingPrice;

			if($end)
				echo '</td></tr>';
				}
		}
	}
	

	//A message if no products are printed.	
	if($count==0){
		echo '<tr><td>The retrieved products are not in stock. Try the Next button or another category.</td><tr>';
	}

	//A hack to make sure the tags are closed.	
	if($end!=1)
		echo '</td></tr>';

	echo '</table>';
//That's all we need for the category view.
	exit();
}
else
	{
		echo out;
	}//Query the API
$home = $flipkart->api_home();

//Make sure there is a response.
if($home==false){
	echo 'Error: Could not retrieve API homepage';
	exit();
}
}

?>