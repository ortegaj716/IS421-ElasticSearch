<?php

require 'ctwitter_stream.php';

$t = new ctwitter_stream();

$t->login('yyxU2w8Pvjqvqs1NPxTWsFduG', 'mP6wouXYFiRMJf8licTusGBWmH3ygCZ3A39Oi9uQ0BnOuKPk2y', '2875434483-aa9nYdrigB2RVd6pEOdP9pNoSa2fkWA8hKfRJ90', 'ccnFZGHnwqPHkXJMhyjAtt3qiWUKl325SyVx360z2NyJx');

$t->start(array('facebook', 'fbook', 'fb'));

?>