<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Inicializar historial
if (!isset($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Borrar historial
    if (isset($_POST["borrar"])) {
        $_SESSION["historial"] = [];
    } else {

        $num1 = floatval($_POST["num1"]);
        $num2 = floatval($_POST["num2"]);
        $operacion = $_POST["operacion"];

        switch ($operacion) {
            case "suma":
                $resultado = $num1 + $num2;
                $texto = "$num1 + $num2 = $resultado";
                break;

            case "resta":
                $resultado = $num1 - $num2;
                $texto = "$num1 - $num2 = $resultado";
                break;

            case "multiplicacion":
                $resultado = $num1 * $num2;
                $texto = "$num1 * $num2 = $resultado";
                break;

            case "division":
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                    $texto = "$num1 / $num2 = $resultado";
                } else {
                    $texto = "Error: División por cero";
                }
                break;

            case "porcentaje":
                $resultado = ($num1 * $num2) / 100;
                $texto = "$num2% de $num1 = $resultado";
                break;
        }

        // Guardar en historial
        $_SESSION["historial"][] = $texto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
</head>
<body>

<h1>Calculadora</h1>

<form method="POST">
    <input type="number" step="any" name="num1" placeholder="Número 1" required>
    <input type="number" step="any" name="num2" placeholder="Número 2" required>

    <br><br>

    <select name="operacion">
        <option value="suma">Suma</option>
        <option value="resta">Resta</option>
        <option value="multiplicacion">Multiplicación</option>
        <option value="division">División</option>
        <option value="porcentaje">Porcentaje</option>
    </select>

    <br><br>

    <button type="submit">Calcular</button>
    <button type="submit" name="borrar">Borrar Historial</button>
</form>

<?php if ($resultado !== ""): ?>
    <h2>Resultado: <?php echo $resultado; ?></h2>
<?php endif; ?>

<h2>Historial:</h2>

<ul>
    <?php foreach ($_SESSION["historial"] as $item): ?>
        <li><?php echo $item; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>