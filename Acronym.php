<?php

class Acronym {

    private $phrase;

    public function __construct($phrase) {
        $this->phrase = $phrase;
    }

    public function generate() {
        // Convertir guiones en espacios
        $text = str_replace('-', ' ', $this->phrase);

        // Eliminar signos de puntuación excepto letras y espacios
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
?>