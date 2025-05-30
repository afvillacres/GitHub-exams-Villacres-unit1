<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
    $modelo = trim($_POST["modelo"]);
    $marca = trim($_POST["marca"]);
    $precio = floatval($_POST["precio"]);
    $caracteristicas = trim($_POST["caracteristicas"]);

    if ($id !== '') {
        $stmt = $conn->prepare("UPDATE smartwatches SET modelo = ?, marca = ?, precio = ?, caracteristicas = ? WHERE id = ?");
        $stmt->bind_param("ssdsi", $modelo, $marca, $precio, $caracteristicas, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO smartwatches (modelo, marca, precio, caracteristicas) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $modelo, $marca, $precio, $caracteristicas);
    }

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>