<?php
$mysqli = new mysqli("localhost", "root", "", "fsp_tugas2");

$stateOfBoard = $_POST['stateOfBoard'];
$role = $_POST['role'];

// $sql = "SELECT * FROM tictactoe WHERE id=1";
// $result = $mysqli->query($sql);
// $data = $result->fetch_assoc();


$stmnt = $mysqli->prepare("UPDATE tictactoe SET board_state=?, last_turn=?");
$stmnt->bind_param('ss', $stateOfBoard, $role);
$success = $stmnt->execute();

echo $success;

$mysqli->close();