<?php

include './AppleJWT.php';

echo "Hello World!\n";

// get text from the file
$appleJWT_text = file_get_contents('../tests2/data/signedPayload1.json');

$result = AppleJWT::decode($appleJWT_text);


print_r($result);

$keys = array_keys($result);

print_r($keys);

$values = array_values($result);

print_r($values);

// accepted by the database
$sql = "INSERT INTO subscriptions (" . implode(", ", $keys) . ") VALUES ('" . implode("', '", $values) . "');";
echo $sql . "\n";
