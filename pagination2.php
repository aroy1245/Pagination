<style>
    .links{
        display:flex;
        justify-content:center;
        padding:30px;
        align-items:center;
    }
    .links a{
        padding:10px;
        text-decoration:none;
        border-radius:5px;
    }
    .links a:hover{
        background:#cccccc;
    }
</style>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "laravel";

$con = mysqli_connect($servername, $username, $password, $database);
if($con ==true){
    $query = "SELECT * FROM user_data";
    $fetch_data = mysqli_query($con,$query);
    $number_of_result = mysqli_num_rows($fetch_data);
    $results_per_page = 10;
    $number_of_page = ceil($number_of_result / $results_per_page);
    // print_r($number_of_page);
    if (!isset($_GET['page'])) {
        $page = 1;
    //    die;
    } else {
        $page = $_GET['page'];
    //    die;
    }
    $page_first_result = ($page - 1) * $results_per_page;
    $set_data = "SELECT *FROM user_data LIMIT " . $page_first_result . ',' . $results_per_page;
    $result = mysqli_query($con, $set_data);

    echo  "<table> 
    <tr>
        <th>ID</th>
        <th>FULL NAME</th>
        <th>EMAIL ID</th>
        <th>ADDRESS</th>
    </tr>";
    foreach ($result as $item => $value) {
        echo "<tr>
                <td>" . $value['id'] . "</td>
                <td>" . $value['full_name'] . "</td>
                <td>" . $value['email_id'] . "</td>
                <td>" . $value['address'] . "</td>
            </tr>";
    }
    echo "</table>";
    $link = "";
    $pages = ceil($number_of_result/$results_per_page); // Total number of pages
    
    $limit = 5; // May be what you are looking for
    
    if ($pages >= 1 && $page <= $pages) {
        $counter = 1;
        $link = "";
        if ($page > ($limit / 2)) {
            $link .= "<a href=\"?page=1\">1 </a> ... ";
        }
        for ($x = $page; $x <= $pages; $x++) {
    
            if ($counter < $limit)
                $link .= "<a href=\"?page=".$x."\">" . $x . " </a>";
    
            $counter++;
        }
        if ($page < $pages - ($limit / 2)) {
            $link .= "... " . "<a href=\"?page=".$pages."\">" . $pages . " </a>";
        }
    }
    
    echo "<div class='links'> <div><a href='pagination2.php?page=".($page-1)."'>< PREVIOUS</a></div>".$link."<div><a href='pagination2.php?page=".($page+1)."'>< NEXT</a></div></div>";
    die;
}










