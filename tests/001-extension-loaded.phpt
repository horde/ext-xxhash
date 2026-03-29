--TEST--
Check if horde_xxhash extension is loaded and function exists
--SKIPIF--
<?php
if (!extension_loaded('horde_xxhash')) {
    die('skip horde_xxhash extension not available');
}
?>
--FILE--
<?php
// Check extension is loaded
echo "Extension loaded: ";
var_dump(extension_loaded('horde_xxhash'));

// Check extension version
echo "Extension version: ";
$version = phpversion('horde_xxhash');
echo ($version !== false) ? $version . "\n" : "version not available\n";

// Check function exists
echo "Function horde_xxhash exists: ";
var_dump(function_exists('horde_xxhash'));

// Check function is callable
echo "Function is callable: ";
var_dump(is_callable('horde_xxhash'));

// Check reflection (function signature)
if (function_exists('horde_xxhash')) {
    $reflection = new ReflectionFunction('horde_xxhash');
    echo "Number of required parameters: " . $reflection->getNumberOfRequiredParameters() . "\n";
    echo "Number of parameters: " . $reflection->getNumberOfParameters() . "\n";

    // Get parameter info
    $params = $reflection->getParameters();
    if (!empty($params)) {
        echo "First parameter name: " . $params[0]->getName() . "\n";
    }
}

echo "All checks passed\n";
?>
--EXPECT--
Extension loaded: bool(true)
Extension version: 1.0.0
Function horde_xxhash exists: bool(true)
Function is callable: bool(true)
Number of required parameters: 1
Number of parameters: 1
First parameter name: data
All checks passed
