<?php
$mysqli = new mysqli("localhost", "root", "", "fsp_tugas2");

$sql = "SELECT * FROM tictactoe WHERE id=1";
$result = $mysqli->query($sql);
$data = $result->fetch_assoc();

$data_dr_server = $data['board_state'] . "//" . $data['last_turn'];

echo $data_dr_server;

$mysqli->close();
?>