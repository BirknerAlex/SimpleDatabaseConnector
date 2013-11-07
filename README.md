SDC - SimpleDatabaseConnector
=============================

Simple PHP Database Connector 

* works with mysqli
* very simple ;)

query() Example: 

```
<?php

$db = new mysqli("localhost", "dbUser", "dbPassword", "dbName");
$sdc = new DatabaseConnector($db);

$name = "Franz";

$sql = "UPDATE
            `table`
        SET
            `col` = '1'
        WHERE
            `name` = ".$sdc->quote($name").";";

$sdc->query($sql);

```

getAll() Example: 

```
<?php

$db = new mysqli("localhost", "dbUser", "dbPassword", "dbName");
$sdc = new DatabaseConnector($db);

$sql = "SELECT
            `name`
        FROM
            `table`
        LIMIT
            `10`";

$entries = $sdc->getAll($sql);

foreach ($entries as $entry) {
    echo $entry["name"];
}

```

getOne() Example:

```
<?php

$db = new mysqli("localhost", "dbUser", "dbPassword", "dbName");
$sdc = new DatabaseConnector($db);

$sql = "SELECT
            `name`
        FROM
            `table`
        WHERE
            `id` = '1'";

$name = $sdc->getOne($sql);

echo $name;

```
