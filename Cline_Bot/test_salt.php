<?php
// Simple test to verify Security.salt is working
require 'config/bootstrap.php';

use Cake\Utility\Security;

echo "Security.salt is set to: " . Security::getSalt() . "\n";
echo "Test passed - no Security::setSalt() error!\n";
