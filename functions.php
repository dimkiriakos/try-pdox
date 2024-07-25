<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

$db = new \Buki\Pdox($config);


function create_user($name, $email){
    global $db;

    if ( ($name !== null) || ($email !== null) ){
        $db->table('users')->insert([
            'name'      => strip_tags($name),
            'email'     => strip_tags($email),
        ]);
    }
}



function get_users(){
    global $db;

    return $db->table('users')->getAll();
}

function delete_user($id){
    global $db;

    $db->table('users')->where('id', '=', $id)->delete();
}


function update_user($id, $data){
    global $db;

    $db->table('users')->where('id', '=', $id)->update($data);
}