<?php

$path = __DIR__ .
    "/public/uploads/skills";
$ext = "png";
$start = 1;
$end = 40;

for ($i = $start + 1; $i <= $end; $i++) {
    copy("$path/1.$ext", "$path/$i.$ext");
    echo "image $i.$ext generated successfully <br>";
}
