<?php
$mysqli = new mysqli("localhost", "root", "", "fsp_tugas2");

$stateOfBoard = $_POST['stateOfBoard'];
$role = $_POST['role'];

//$game_is_done = $_POST['game_is_done'];

$sql = "SELECT * FROM tictactoe WHERE id=1";
$result = $mysqli->query($sql);
$data = $result->fetch_assoc();

if($data['last_turn'] == $role)
{
	echo "false";
}
else
{
	$stmnt = $mysqli->prepare("UPDATE tictactoe SET board_state=?, last_turn=?");
	$stmnt->bind_param('ss', $stateOfBoard, $role);
	$success = $stmnt->execute();

	echo $success;
}
$mysqli->close();