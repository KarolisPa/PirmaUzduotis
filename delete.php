<?php
$id = $_GET['id'];

$data = file_get_contents('kontaktai.json');
$data = json_decode($data, true);

unlink('nuotraukos/'.$data[$id]['Foto']);
unset($data[$id]);


$data = json_encode($data, JSON_PRETTY_PRINT);

file_put_contents('kontaktai.json', $data);
header('location: index.php');
?>
