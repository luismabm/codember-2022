<?php

/**
 * Codember - Challenge 01
 * 
 * The database is very old and it's in a strange format. The profiles require the following data:
    usr: username
    eme: email
    psw: password
    age: age
    loc: location
    fll: number of followers
 *
 * Hints
    The data can be in any order.
    The data can be on the same line or separated by lines.
    The users are separated by a blank newline.
    The users can be repeated, but it doesn't matter, they are still valid.
    There can be data that is not necessary for the user but that does not make them invalid.
 */

$users = file_get_contents(__DIR__.'/users.txt');
$users = explode("\n\n", $users);

$users_new = array_map('getValidUserRow', $users);
$filtered = array_filter($users_new, static function($var){return $var !== null;} );
var_dump(count($filtered));


function getValidUserRow($user_info): ?array
{
    $user_info = str_replace("\n", ' ', $user_info);
    $user_info = explode(' ', $user_info);

    $user = [];
    foreach($user_info AS $id=>$col){
        if(!empty($col)){
            [$key, $value] = explode(':', $col);
            $user[$key] = $value;
        }
    }

    if(isValid($user)){
        return $user;
    }

    return null;
}

function isValid($user): bool
{
    if(!isset($user['usr'], $user['eme'],$user['psw'],$user['age'],$user['loc'],$user['fll'])){
        return false;
    }

    return true;
}