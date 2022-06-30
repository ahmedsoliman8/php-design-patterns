<?php

require 'vendor/autoload.php';

$cat = new \App\Cat\Cat(
	new \App\Cat\Actions\Speak\MeowAction,
	new \App\Cat\Actions\Jump\JumpAction
);

$cat->setSpeakAction(new \App\Cat\Actions\Speak\GrowlAction);

echo $cat->speak();
