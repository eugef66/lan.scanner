<?php

foreach ($_POST as $key => $value) {
    echo htmlspecialchars($key) . " : ". htmlspecialchars($value)."<br>";
}
?>