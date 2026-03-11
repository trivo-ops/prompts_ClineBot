<?php
// Test to verify Security.salt configuration is working
require 'config/bootstrap.php';

use Cake\Utility\Security;

echo "Security.salt is set to: " . Security::getSalt() . "\n";
echo "✅ Configuration fix successful - no Security::setSalt() error!\n";
