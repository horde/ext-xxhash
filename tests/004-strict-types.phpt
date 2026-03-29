--TEST--
horde_xxhash() type enforcement with strict_types
--EXTENSIONS--
horde_xxhash
--FILE--
<?php
declare(strict_types=1);

echo "=== Strict Types Enabled ===\n\n";

// Valid string
echo "Valid string 'test':\n";
var_dump(horde_xxhash('test'));

// Integer should fail in strict mode
echo "\nInteger 123 (should fail):\n";
try {
    horde_xxhash(123);
    echo "ERROR: Should have thrown TypeError\n";
} catch (TypeError $e) {
    echo "✓ TypeError: " . $e->getMessage() . "\n";
}

// Float should fail in strict mode
echo "\nFloat 3.14 (should fail):\n";
try {
    horde_xxhash(3.14);
    echo "ERROR: Should have thrown TypeError\n";
} catch (TypeError $e) {
    echo "✓ TypeError: " . $e->getMessage() . "\n";
}

// Null should fail in strict mode
echo "\nNull (should fail):\n";
try {
    horde_xxhash(null);
    echo "ERROR: Should have thrown TypeError\n";
} catch (TypeError $e) {
    echo "✓ TypeError: " . $e->getMessage() . "\n";
}

// Object should fail
echo "\nObject (should fail):\n";
try {
    horde_xxhash(new stdClass());
    echo "ERROR: Should have thrown TypeError\n";
} catch (TypeError $e) {
    echo "✓ TypeError: " . $e->getMessage() . "\n";
}

// Empty string is valid
echo "\nEmpty string (valid):\n";
var_dump(horde_xxhash(''));

?>
--EXPECT--
=== Strict Types Enabled ===

Valid string 'test':
string(8) "3e2023cf"

Integer 123 (should fail):
✓ TypeError: horde_xxhash(): Argument #1 ($data) must be of type string, int given

Float 3.14 (should fail):
✓ TypeError: horde_xxhash(): Argument #1 ($data) must be of type string, float given

Null (should fail):
✓ TypeError: horde_xxhash(): Argument #1 ($data) must be of type string, null given

Object (should fail):
✓ TypeError: horde_xxhash(): Argument #1 ($data) must be of type string, stdClass given

Empty string (valid):
string(8) "02cc5d05"
