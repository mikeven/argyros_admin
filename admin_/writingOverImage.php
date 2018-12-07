<?php

require_once 'class.textPainter.php';

$size = 20;
$text = 'Miguel';

$img = new textPainter('images/uno.jpg', $text, 'fonts/futura medium bt.ttf', $size );
$img->setTextColor(0, 0, 0);
$img->setQuality(100);

$img->show();

