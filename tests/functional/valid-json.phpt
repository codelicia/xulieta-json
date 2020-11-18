--TEST--
Report success with a valid json
--FILE--
<?php

$checkRunner = require __DIR__ . '/init.php';

$checkRunner('tests/assets/valid-json.md');

--EXPECTF--
Finding documentation files on tests/assets/valid-json.md


     Everything is OK!
