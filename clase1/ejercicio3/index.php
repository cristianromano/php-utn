<?php

$a = 5; $b = 1; $c = 5;

if ( ($a > $b && $a < $c) || ($b < $a && $a > $c) ) {
    echo $a;
}

elseif ( ($b > $a && $b < $c) || ($b < $a && $b > $c) ) {
    echo $b;
}

elseif ( ($c > $a && $b > $c) || ($b < $c && $c > $a) ) {
    echo $c;
}

else{
    echo 'no hay valor del medio';
}
