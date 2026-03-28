<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$numeros = [];
$promedio = $media = $moda = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Convertir el texto en array
    $input = $_POST["numeros"];
    $numeros = array_map('floatval', explode(",", $input));

    $cantidad = count($numeros);

    // PROMEDIO (media aritmética)
    $suma = array_sum($numeros);
    $promedio = $suma / $cantidad;

    // MEDIA (en muchos casos es igual al promedio)
    sort($numeros);

    if ($cantidad % 2 == 0) {
        $media = ($numeros[$cantidad/2 - 1] + $numeros[$cantidad/2]) / 2;
    } else {
        $media = $numeros[floor($cantidad/2)];
    }

    // MODA
    $frecuencia = array_count_values($numeros);
    $maxFrecuencia = max($frecuencia);

    $modas = [];
    foreach ($frecuencia as $num => $freq) {
        if ($freq == $maxFrecuencia && $maxFrecuencia > 1) {
            $modas[] = $num;
        }
    }

    $moda = empty($modas) ? "No hay moda" : implode(", ", $modas);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas</title>
</head>
<body>

<h1>Calcular Promedio, Media y Moda</h1>

<form method="POST">
    <label>Ingrese los números separados por comas:</label><br>
    <input type="text" name="numeros" placeholder="Ej: 2,4,4,5,6" required>

    <br><br>

    <button type="submit">Calcular</button>
</form>

<?php if (!empty($numeros)): ?>
    <h2>Resultados:</h2>
    <p><strong>Promedio:</strong> <?php echo $promedio; ?></p>
    <p><strong>Media:</strong> <?php echo $media; ?></p>
    <p><strong>Moda:</strong> <?php echo $moda; ?></p>
<?php endif; ?>

</body>
</html>