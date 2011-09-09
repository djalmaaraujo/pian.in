<?php
/**
 * Aqui você deve definir suas configurações de banco de dados, todas de acordo
 * com um determinado ambiente de desenvolvimento. Você pode definir quantos
 * ambientes forem necessários.
 * 
 */

Config::write("database", array(
    "production" => array(
        "driver" => "mysql",
        "host" => "localhost",
        "user" => "root",
        "password" => "",
        "database" => "pianin",
        "prefix" => ""
    ),
    "a" => array(
        "driver" => "mysql",
        "host" => "127.0.0.1",
        "user" => "pianin_curtin",
        "password" => "^ZPA$xkAGqLW",
        "database" => "pianin_db",
        "prefix" => ""
    )
));

?>