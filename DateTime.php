<?php
$CurrentTime = new DateTime();
$CurrentTime->setTimezone(new DateTimeZone('Europe/Sofia'));
echo $CurrentTime->format('Y-m-d H:i:s T');
?>
