--TEST--
horde_xxhash() type coercion in non-strict mode
--EXTENSIONS--
horde_xxhash
--FILE--
<?php
// No declare(strict_types=1) - allows coercion

echo "=== Non-Strict Mode (Coercion Allowed) ===\n\n";

// Valid string
echo "String 'test':\n";
var_dump(horde_xxhash('test'));

// Integer coerces to string
echo "\nInteger 123 (coerces to '123'):\n";
var_dump(horde_xxhash(123));

// Float coerces to string
echo "\nFloat 3.14 (coerces to '3.14'):\n";
var_dump(horde_xxhash(3.14));

// True coerces to '1'
echo "\nBoolean true (coerces to '1'):\n";
var_dump(horde_xxhash(true));

// False coerces to ''
echo "\nBoolean false (coerces to ''):\n";
var_dump(horde_xxhash(false));

// Object without __toString still fails
echo "\nObject without __toString (still fails):\n";
try {
    horde_xxhash(new stdClass());
    echo "ERROR: Should have thrown TypeError\n";
} catch (TypeError $e) {
    echo "✓ TypeError: Cannot convert stdClass to string\n";
}

?>
--EXPECT--
=== Non-Strict Mode (Coercion Allowed) ===

String 'test':
string(8) "3e2023cf"

Integer 123 (coerces to '123'):
string(8) "b6855437"

Float 3.14 (coerces to '3.14'):
string(8) "65ee94c3"

Boolean true (coerces to '1'):
string(8) "b6ecc8b2"

Boolean false (coerces to ''):
string(8) "02cc5d05"

Object without __toString (still fails):
✓ TypeError: Cannot convert stdClass to string
