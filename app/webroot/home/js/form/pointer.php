<?php

function say_hello () {
    echo "hello world! <br/>";
}

say_hello();

function say_hello2 ($word) {
    echo "hello {$word}! <br/>";
}
say_hello2("word");
say_hello2("everyone");
say_hello2("what the hell");

function say_hello3($greeting, $target, $punct) {
    echo $greeting. ", " . $target . ", " . $punct . "<br/>";
}

$name = "Cong Vu";

say_hello3("hello", $name, "!");

?>

<?php
    function addition($val1, $val2) {
        $sum = $val1 + $val2;
        return $sum;
    }
    $new_val = addition (3, 4);
    echo $new_val;
?>
