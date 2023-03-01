<?php

function utf8_strlen($s)
{

    $c = strlen($s);
    $l = 0;
    for ($i = 0; $i < $c; ++$i) if ((ord($s[$i]) & 0xC0) != 0x80) ++$l;
    return $l;
}
