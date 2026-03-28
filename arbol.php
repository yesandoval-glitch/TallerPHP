<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Nodo {
    public $valor;
    public $izq;
    public $der;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->izq = null;
        $this->der = null;
    }
}

// Construir árbol con Preorden + Inorden
function construirArbol($preorden, $inorden) {
    if (empty($preorden) || empty($inorden)) {
        return null;
    }

    $raizValor = $preorden[0];
    $raiz = new Nodo($raizValor);

    $index = array_search($raizValor, $inorden);

    $izqInorden = array_slice($inorden, 0, $index);
    $derInorden = array_slice($inorden, $index + 1);

    $izqPreorden = array_slice($preorden, 1, count($izqInorden));
    $derPreorden = array_slice($preorden, 1 + count($izqInorden));

    $raiz->izq = construirArbol($izqPreorden, $izqInorden);
    $raiz->der = construirArbol($derPreorden, $derInorden);

    return $raiz;
}

// Recorridos
function preorden($nodo) {
    if ($nodo == null) return [];
    return array_merge([$nodo->valor], preorden($nodo->izq), preorden($nodo->der));
}

function inorden($nodo) {
    if ($nodo == null) return [];
    return array_merge(inorden($nodo->izq), [$nodo->valor], inorden($nodo->der));
}

function postorden($nodo) {
    if ($nodo == null) return [];
    return array_merge(postorden($nodo->izq), postorden($nodo->der), [$nodo->valor]);
}

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pre = !empty($_POST["pre"]) ? explode(",", $_POST["pre"]) : [];
    $in = !empty($_POST["in"]) ? explode(",", $_POST["in"]) : [];

    // Limpiar espacios
    $pre = array_map('trim', $pre);
    $in = array_map('trim', $in);

    if (!empty($pre) && !empty($in)) {
        $arbol = construirArbol($pre, $in);

        $resultados["pre"] = implode(" → ", preorden($arbol));
        $resultados["in"] = implode(" → ", inorden($arbol));
        $resultados["post"] = implode(" → ", postorden($arbol));
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Árbol Binario</title>
</head>
<body>

<h1>Construcción de Árbol Binario</h1>

<form method="POST">
    <label>Preorden (separado por comas):</label><br>
    <input type="text" name="pre" placeholder="A,B,D,E,C">

    <br><br>

    <label>Inorden (separado por comas):</label><br>
    <input type="text" name="in" placeholder="D,B,E,A,C">

    <br><br>

    <button type="submit">Construir Árbol</button>
</form>

<?php if (!empty($resultados)): ?>
    <h2>Recorridos del Árbol:</h2>
    <p><strong>Preorden:</strong> <?php echo $resultados["pre"]; ?></p>
    <p><strong>Inorden:</strong> <?php echo $resultados["in"]; ?></p>
    <p><strong>Postorden:</strong> <?php echo $resultados["post"]; ?></p>
<?php endif; ?>

</body>
</html>