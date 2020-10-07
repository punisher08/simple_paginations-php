<DOCTYPE html>
<html>
<title></title>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container">
<table class="table" id="table">

<?php include('connection.php');
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 1;

	}

	$num_per_page = 10;
	// $num_per_page = $_GET['numpage'];
	$start_from= ($page-1)*10;

	

?>

<?php 
echo '<thead>';
echo '<tr>';

echo '<th>order ID</th>';
echo '<th>status</th>';
echo '<th>Customer ID</th>';
echo '<th>Date created</th>';
echo '</tr>';
echo '</thead>';
$result = mysqli_query($con,"SELECT * FROM wp_wc_order_stats limit $start_from,$num_per_page");
// $result = mysqli_query($con,"SELECT * FROM wp_wc_order_stats");
$number=0;
while($row = mysqli_fetch_array($result))
  {
	
	echo '<tbody>';
	
		echo '<td>'.$row['order_id'].'</td>';
		echo '<td>'.$row['status'].'</td>';
		echo '<td>'.$row['customer_id'].'</td>';
		echo '<td>'.$row['date_created'].'</td>';

	echo '</tbody>';
	
  }

  


// mysqli_close($con);
?>
</table>
</div>
<?php  
	$pr_query = "select *from wp_wc_order_stats ";
	$pr_result = mysqli_query($con,$pr_query);
	$total_record = mysqli_num_rows($pr_result);
	

	$total_pages = ceil($total_record/$num_per_page);



	for($i=1; $i<=$total_pages;$i++){

	echo "<a href='pagination.php?page=".$i."' class='btn btn-primary'>$i</a>";
	}

	// $totals = count($total_pages);
	 mysqli_close($con);
?>
    