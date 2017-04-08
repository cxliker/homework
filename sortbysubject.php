<?php

$con = connectDB();

//$sql = "SELECT * FROM Everyday_subjects ORDER BY date DESC";
$sql = "SELECT * FROM subjects";
if ($result = $con->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        //everyDay($row);
        everySubjectsBySub($row);
    }
} else {
    echo "Error: " . $con->error;
}

function connectDB(){
    $con = new mysqli("localhost","root","root","homework");
    if($con->connect_errno)
        die('Could not connect:'. $con->connect_error);
    $con->query("set names utf8");
    return $con;
}

function everySubjectsBySub($row) {
    echo "<li><article>$row[title]";
    everyDayBySub($row["title"]);
    echo "</article></li>";
}

function everyDayBySub($sub) {
    $con = connectDB();
    $sql = "SELECT distinct date FROM $sub ORDER BY date DESC";
    $rst = $con->query($sql);
    $date = [];
    while ($row = $rst->fetch_assoc()) {
        $date[] = $row["date"];
    }
    $sql = "SELECT * FROM $sub ORDER BY date DESC";
    $rst = $con->query($sql);
    $sub = [];
    while ($row = $rst->fetch_assoc()) {
        $sub[] = $row;
    }

    $j = 0;
    $dateLen = count($date);
    $subLen = count($sub);
    echo "<ul>";
    for ($i = 0 ; $i < $dateLen ; $i++) {
        echo "<li>$date[$i]<ul>";
        for (; $j < $subLen ; $j++) {
            if ($sub[$j]["date"] === $date[$i]) {
                echo "<li>";
                echo $sub[$j]["content"];
                echo "</li>";
            } else {
                break;
            }
            
        }
        echo "</ul></li>";
    }
    echo "</ul>";

    
}