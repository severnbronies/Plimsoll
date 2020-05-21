<?php

if (!isset($timberContext)) {
	throw new \Exception('Timber context not set in footer.');
}
ob_end_clean();
