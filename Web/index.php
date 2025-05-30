<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Watches</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.php"></script>
</head>
<body>
    <center><h1>Lista de Smart Watches</h1></center>
    <br>
    <form action="save-watch.php" method="post">
        <input type="hidden" name="id"> <!-- Se usará para actualizar si es necesario -->
        <label>Modelo: <input type="text" name="modelo" required></label><br><br>
        <label>Marca: <input type="text" name="marca" required></label><br><br>
        <label>Precio: <input type="number" step="0.01" name="precio" required></label><br><br>
        <label>Características:<br>
            <textarea name="caracteristicas" rows="4" cols="50" required></textarea>
        </label><br><br>
        <button type="submit">Guardar</button>
    </form>
    <div class="watch-list">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Características</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM smartwatches";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                        echo "<td>$" . htmlspecialchars($row['precio']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['caracteristicas']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay relojes registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>