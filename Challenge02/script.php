<?php
/**
 * Codember - Challenge 02
 *
 * could be using the ASCII code of the lowercase letters
 *
 * Hints
Remember that the messages are text strings made up of numbers and spaces.
It seems that the numbers have something to do with the ASCII code.
The whitespaces seem to be just whitespaces...
 */

const DEDOCE_MIN = 97;

$code_string = explode(" ", file_get_contents(__DIR__.'/encrypted.txt'));
$result = array_map('decodeString', $code_string);
var_dump(html_entity_decode(implode(' ', $result)));

function decodeString($string): string
{
    $offset = 0;
    $lenght = strlen($string);
    $response = '';
    do{
        $code = substr($string, $offset, 2);
        if((int)$code<DEDOCE_MIN){
            $code = substr($string, $offset, 3);
            $offset += 3;
        } else {
            $offset += 2;
        }
        $response .= '&#'.$code.';';
    }while($offset<$lenght);

    return $response;
}