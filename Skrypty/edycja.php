<?php
require_once "base.php";
// 1. Pobieramy ID produktu z adresu URL (np. /produkt.php?id=5)
$idedycji = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Pobieramy dane produktu z bazy danych (symulacja)
// $db -> tu połączenie z bazą
$sql = "SELECT * FROM `gallery` WHERE ID=".$idedycji;
$query = mysqli_query($link,$sql); 
$row = mysqli_fetch_assoc($query);

if (!$query) {
    http_response_code(404);
    echo "Produkt nie istnieje!";
    exit;
}

// 3. Włączamy buforowanie wyjścia i dołączamy szablon
ob_start();
include '../Template-Edycja.php';
$stronaProduktu = ob_get_clean();

// 4. Wyświetlamy gotową stronę użytkownikowi
echo $stronaProduktu;
?>