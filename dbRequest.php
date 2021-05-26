<?php
require_once('config.php');
$memberid = $_GET['id'];
if (isset($_GET['id'])) {
    $query = "SELECT * FROM team_bios WHERE id = '$memberid'";
    $result = $dbci->query($query);
    
    while ($row = $result->fetch_all()) {
        echo json_encode($row);
    }
}
