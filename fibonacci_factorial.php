<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$result = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = intval($_POST["number"]);
    $operation = $_POST["operation"];

    if ($operation == "fibonacci") {
        $a = 0;
        $b = 1;

        for ($i = 0; $i < $number; $i++) {
            $result[] = $a;
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }
    }

    if ($operation == "factorial") {
        $fact = 1;

        for ($i = 1; $i <= $number; $i++) {
            $fact *= $i;
            $result[] = $fact;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fibonacci o Factorial</title>
</head>
<body>

<h1>Calculadora de Series</h1>

<form method="POST">
    <label>Número:</label>
    <input type="number" name="number" required>

    <br><br>

    <label>Operación:</label>
    <select name="operation">
        <option value="fibonacci">Fibonacci</option>
        <option value="factorial">Factorial</option>
    </select>

    <br><br>

    <button type="submit">Calcular</button>
</form>

<?php if (!empty($result)): ?>
    <h2>Resultado:</h2>
    <p>
        <?php echo implode(" , ", $result); ?>
    </p>
<?php endif; ?>

</body>
</html>