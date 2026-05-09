<?php

class Acronym {

    private $phrase;

    public function __construct($phrase) {
        $this->phrase = $phrase;
    }

    public function generate() {

        // Convertir guiones en espacios
        $text = str_replace('-', ' ', $this->phrase);

        // Eliminar signos especiales
        $text = preg_replace('/[^a-zA-Z\s]/', '', $text);

        // Separar palabras
        $words = explode(' ', $text);

        $acronym = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $acronym .= strtoupper($word[0]);
            }
        }

        return $acronym;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $frase = $_POST["frase"];

    $objeto = new Acronym($frase);

    $resultado = $objeto->generate();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acrónimo</title>

</head>
<body>

    <h1>Generador de Acrónimos</h1>

    <form method="POST">

        <input type="text" name="frase" placeholder="Ingrese una frase" required>

        <button type="submit">Generar</button>

    </form>

    <div class="resultado">

        <?php
            if($resultado != ""){
                echo "Acrónimo: " . $resultado;
            }
        ?>

    </div>

</body>
</html>