<?php

$con = connectDB();

$sql = "SELECT * FROM Everyday_subjects ORDER BY date DESC";
//$sql = "SELECT * FROM subjects";
if ($result = $con->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        everyDay($row);
        //everySubjectsBySub($row);
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

function everyDay($row){
    echo "<li><article><p class='date'>$row[date]</p>";
    everySubject($row);
    echo "</article></li>";
}

function everySubject($row){
    echo "<ul class='details'>";
    foreach ($row as $key => $value) {
        if(!is_numeric($key) && $key != 'date' && $value == 1){
            switch ($key) {
                case 'OOP':
                    $subj = "程序设计与算法";
                    break;
                case 'Marx':
                    $subj = "马克思注意基本原理概论";
                    break;
                case 'Math':
                    $subj = "线性代数";
                    break;			
                case 'Computer':
                    $subj = "计算机组成原理";
                    break;				
                
                default:
                    $subj = $key;
                    break;
            }
            echo "<li>$subj";
            everyDetails($row['date'],$key);
            echo "</li>";
        }
    }
    echo "</ul>";
}

function everyDetails($date,$subject){
    $con = connectDB();
    echo "<ul>";
    $query = "SELECT content FROM $subject WHERE date = '".$date."'";
    $rst = $con->query($query);
    while($row = $rst->fetch_assoc()){
        echo "<li>$row[content]</li>";
    }
    echo "</ul>";
}