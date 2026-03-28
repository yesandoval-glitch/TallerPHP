<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$A = $B = [];
$union = $interseccion = $diferenciaAB = $diferenciaBA = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Convertir inputs en arrays de enteros
    $A = array_map('intval', explode(",", $_POST["conjuntoA"]));
    $B = array_map('intval', explode(",", $_POST["conjuntoB"]));

    // Eliminar duplicados (porque son conjuntos)
    $A = array_unique($A);
    $B = array_unique($B);

    // UNIÓN
    $union = array_unique(array_merge($A, $B));

    // INTERSECCIÓN
    $interseccion = array_intersect($A, $B);

    // DIFERENCIA A - B
    $diferenciaAB = array_diff($A, $B);

    // DIFERENCIA B - A
    $diferenciaBA = array_diff($B, $A);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Operaciones con Conjuntos</title>
</head>
<body>

<h1>Operaciones con Conjuntos</h1>

<form method="POST">
    <label>Conjunto A (separado por comas):</label><br>
    <input type="text" name="conjuntoA" placeholder="Ej: 1,2,3,4" required>

    <br><br>

    <label>Conjunto B (separado por comas):</label><br>
    <input type="text" name="conjuntoB" placeholder="Ej: 3,4,5,6" required>

    <br><br>

    <button type="submit">Calcular</button>
</form>

<?php if (!empty($A) && !empty($B)): ?>
    <h2>Resultados:</h2>

    <p><strong>Unión:</strong> <?php echo implode(", ", $union); ?></p>
    <p><strong>Intersección:</strong> <?php echo implode(", ", $interseccion); ?></p>
    <p><strong>A - B:</strong> <?php echo implode(", ", $diferenciaAB); ?></p>
    <p><strong>B - A:</strong> <?php echo implode(", ", $diferenciaBA); ?></p>
<?php endif; ?>

</body>
</html>