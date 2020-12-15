--TEST--
Report error when invalid json is detected
--FILE--
<?php

$checkRunner = require __DIR__ . '/init.php';

$checkRunner('tests/assets/invalid-json.md');

--EXPECTF--
Finding documentation files on tests/assets/invalid-json.md

 --> tests/assets/invalid-json.md
 1 |   {
 2 |     "nosso": "",
 3 |     "erro": "
 4 |   }
   | |
     = note: Control character error, possibly incorrectly encoded


     Operation failed!
