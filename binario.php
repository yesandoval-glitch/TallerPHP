<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$numero = "";
$binario = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = intval($_POST["numero"]);

    // Conversión manual a binario
    if ($numero == 0) {
        $binario = "0";
    } else {
        $n = $numero;
        $resultado = "";

        while ($n > 0) {
            $residuo = $n % 2;
            $resultado = $residuo . $resultado;
            $n = floor($n / 2);
        }

        $binario = $resultado;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Convertir a Binario</title>
</head>
<body>

<h1>Convertidor a Binario</h1>

<form method="POST">
    <label>Ingrese un número entero:</label><br>
    <input type="number" name="numero" required>

    <br><br>

    <button type="submit">Convertir</button>
</form>

<?php if ($binario !== ""): ?>
    <h2>Resultado:</h2>
    <p><strong>Binario:</strong> <?php echo $binario; ?></p>
<?php endif; ?>

</body>
</html>