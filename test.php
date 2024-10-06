<?php

require "AddressIPv4.php";

try {
    $good_address = new AddressIPv4("192.168.147.58");
    var_dump($good_address->set("192.168.147.57"));
    var_dump($good_address->getAsBinaryString());
    var_dump($good_address->getAsInt());
    var_dump($good_address->getAsString());
    var_dump($good_address->getClass());
    var_dump($good_address->getOctet(4));
    var_dump($good_address->isPrivate());
} catch (Exception $e) {
    echo $e->getMessage();
}