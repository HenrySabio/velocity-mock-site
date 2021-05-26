<?php
require_once('config.php');

    $table = "SELECT * FROM team_bios";
    $result = $dbci->query($table);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<img src=".$row["photo"]." style='width:100px'><br>";
            echo "name: ".$row["name"]. "<br>title: ".$row["title"]."<br>bio: ".$row["bio"];
        }
    } else {
    echo "No data to display.";
    }
    $dbci->close();
