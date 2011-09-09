<?php
/**
 *  A classe Inflector é responsável pelas conversões de strings como remoção de
 *  acentos e caracteres especiais, camelização e humanização de strings, entre outros.
 *
 *  @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 *  @copyright Copyright 2008-2009, Spaghetti* Framework (http://spaghettiphp.org/)
 *
 */

class Inflector extends Object {
    /**
     *  Transforma uma string para o formato camelizado. Ex.: a-casa-amarela => aCasaAmarela
     *  
     *  @param string $string String de entrada
     *  @return string String de saída
     */ 
    public static function camelize($string = "") {
        return str_replace(" ", "", ucwords(str_replace(array("_", "-"), " ", $string)));
    }
    /**
     *  Transforma uma string para o formato humanizado. Ex.: a-casa-amarela => A Casa Amarela
     *  
     *  @param string $string String de entrada
     *  @return string String de saída
     */
    public static function humanize($string = "") {
        return ucwords(str_replace(array("_", "-"), " ", $string));
    }
    /**
     *  Substitui os espaços de uma string pelo "_" e converte as letras para caixa-baixa.
     *  Ex.: A Casa Amarela => a_casa_amarela
     *  
     *  @param string $string String de entrada
     *  @return strign String de saída
     */
    public static function underscore($string = "") {
        return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));
    }
    /**
     *  Transforma uma string no formato slug, em caixa-baixa, com espaços substituídos
     *  por hífens, com a remocao de caracteres acentuados e especiais, deixando
     *  apenas letras minúsculas.
     * 
     *  @param string $string String de entrada
     *  @param string $replace String para substituição do espaço
     *  @return string String de saída
     */
    public static function slug($string = "", $replace = "-") {
        $map = array(
            "/À|à|Á|á|å|Ã|â|Ã|ã/" => "a",
            "/È|è|É|é|ê|ê|ẽ|Ë|ë/" => "e",
            "/Ì|ì|Í|í|Î|î/" => "i",
            "/Ò|ò|Ó|ó|Ô|ô|ø|Õ|õ/" => "o",
            "/Ù|ù|Ú|ú|ů|Û|û|Ü|ü/" => "u",
            "/ç|Ç/" => "c",
            "/ñ|Ñ/" => "n",
            "/ä|æ/" => "ae",
            "/Ö|ö/" => "oe",
            "/Ä|ä/" => "Ae",
            "/Ö/" => "Oe",
            "/ß/" => "ss",
            "/[^\w\s]/" => " ",
            "/\\s+/" => $replace,
            "/^{$replace}+|{$replace}+$/" => ""
        );
        return strtolower(preg_replace(array_keys($map), array_values($map), $string));
    }
    /**
     *  Substitui o hífens "-" na string pelo caractere underscore "_".
     * 
     *  @param string $string String de entrada
     *  @return string String de saída
     */
    public static function hyphenToUnderscore($string = "") {
        return str_replace("-", "_", $string);
    }
}

?>