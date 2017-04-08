<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 2017/3/29
 * Time: 上午 11:34
 */
if ($_REQUEST["type"] ==  "summit") {
    $mysqli = new mysqli("localhost","root", "root", "homework");
    $name = $_REQUEST["name"];
    $content = $_REQUEST['content'];
    date_default_timezone_set('Asia/Shanghai');
    $time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO chat VALUES ('$name', '$content', '$time')";
    if (!$mysqli->query($sql)) {
        echo "Error: " . $mysqli->error;
    }

    /*$sql = "SELECT * FROM chat ORDER BY time DESC";
    $rows = array();
    if ($result = $mysqli->query($sql)) {
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }
    }*/
    // echo json_encode($rows);
    echo $time;

} else if ($_REQUEST["type"] == "get") {
    $mysqli = new mysqli("localhost","root", "root", "homework");
    $sql = "SELECT * FROM chat WHERE time > '" . $_REQUEST["id"] . "' ORDER BY time DESC";
    $rows = array();
    if ($result = $mysqli->query($sql)) {
        while ($r = $result->fetch_assoc()) {
            $rows[] = $r;
        }
    }
    echo json_encode($rows);
}
