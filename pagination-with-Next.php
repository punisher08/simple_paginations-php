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

    $pr_query = "select *from wp_wc_order_stats ";
	$pr_result = mysqli_query($con,$pr_query);
    $total_record = mysqli_num_rows($pr_result);
    /* set records per page */
    $records_per_page = 5;

    /* calculate total pages */
    $total_pages = ceil($total_record / $records_per_page);

    /* get and set value for current page */
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }

    /* calculate and set previous and next page values */
    $previous = $current_page - 1;
    $next = $current_page + 1;

    /* set start page value */
    $start_page = 1;

    /* set number of pages to display to the left */
    /* maximum value should be 4 */
    $pages_to_left = 2;

    /* set number of pages to display to the right */
    /* maximum value should be 4 */
    $pages_to_right = 2;

    /* show previous pages to the left */
    if ($current_page <= $total_pages && $current_page > $start_page + $pages_to_left) {
        $start_page = $current_page - $pages_to_left;
    }

    /* show next pages to the right */
    if ($current_page <= $total_pages && $current_page > $start_page - $pages_to_right) {
        $end_page = $current_page + $pages_to_right;
        if ($current_page == $total_pages || $current_page + 1 == $total_pages || $current_page + 2 == $total_pages || $current_page + 3 == $total_pages) {
            $end_page = $total_pages;
        }
    } else {
        $end_page = $total_pages;
    }

   /* show previous button */
   if ($current_page > 1) {
    echo '<a href="?page='.$previous.'">Previous&laquo;</a>';
    echo "&nbsp;&nbsp;";
}

/* display pages */
for ($page = $start_page; $page <= $end_page; $page++) {
    echo '<a  href="?page='.$page.'">'.$page.'</a>';
    echo "&nbsp;&nbsp;";
}

/* show last page button */
if ($end_page + $pages_to_right <= $total_pages || $end_page != $total_pages) {
    echo '<a class="selected" href="?page='.$total_pages.'">&hellip;' . $total_pages . '</a>';
}

/* show next button */
if ($current_page < $total_pages) {
    echo "&nbsp;&nbsp;";
    echo '<a href="?page='.$next.'">Next&raquo;</a>';
}
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
$result = mysqli_query($con,"SELECT * FROM wp_wc_order_stats limit $start_page,$records_per_page");
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
mysqli_close($con);
?>
</table>
</div>
