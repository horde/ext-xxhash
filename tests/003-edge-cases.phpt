--TEST--
horde_xxhash() edge cases - empty string, binary data, UTF-8
--SKIPIF--
<?php
if (!extension_loaded('horde_xxhash')) {
    die('skip horde_xxhash extension not available');
}
?>
--FILE--
<?php
echo "Testing edge cases:\n\n";

// Test 1: Empty string
echo "Test 1: Empty string\n";
$hash = horde_xxhash('');
if (is_string($hash) && preg_match('/^[0-9a-f]{8}$/', $hash)) {
    echo "PASS: Empty string returns valid hash: $hash\n";
} else {
    echo "FAIL: Invalid hash for empty string\n";
}

// Test 2: Binary data (null bytes)
echo "\nTest 2: Binary data with null bytes\n";
$binary = "\x00\xFF\x80";
$hash = horde_xxhash($binary);
if (is_string($hash) && preg_match('/^[0-9a-f]{8}$/', $hash)) {
    echo "PASS: Binary data returns valid hash: $hash\n";
} else {
    echo "FAIL: Invalid hash for binary data\n";
}

// Test 3: UTF-8 multibyte characters
echo "\nTest 3: UTF-8 multibyte string\n";
$utf8 = 'Hello 世界 🌍';
$hash = horde_xxhash($utf8);
if (is_string($hash) && preg_match('/^[0-9a-f]{8}$/', $hash)) {
    echo "PASS: UTF-8 string returns valid hash: $hash\n";
} else {
    echo "FAIL: Invalid hash for UTF-8 string\n";
}

// Test 4: Very long string
echo "\nTest 4: Large string (10KB)\n";
$large = str_repeat('A', 10240);
$hash = horde_xxhash($large);
if (is_string($hash) && preg_match('/^[0-9a-f]{8}$/', $hash)) {
    echo "PASS: Large string returns valid hash: $hash\n";
} else {
    echo "FAIL: Invalid hash for large string\n";
}

// Test 5: String with newlines
echo "\nTest 5: String with newlines\n";
$multiline = "line1\nline2\rline3\r\n";
$hash = horde_xxhash($multiline);
if (is_string($hash) && preg_match('/^[0-9a-f]{8}$/', $hash)) {
    echo "PASS: Multiline string returns valid hash: $hash\n";
} else {
    echo "FAIL: Invalid hash for multiline string\n";
}

// Test 6: Numeric string (should not be confused with integer)
echo "\nTest 6: Numeric string\n";
$numeric = '12345';
$hash = horde_xxhash($numeric);
if (is_string($hash) && preg_match('/^[0-9a-f]{8}$/', $hash)) {
    echo "PASS: Numeric string returns valid hash: $hash\n";
} else {
    echo "FAIL: Invalid hash for numeric string\n";
}

echo "\nAll edge case tests completed\n";
?>
--EXPECT--
Testing edge cases:

Test 1: Empty string
PASS: Empty string returns valid hash: 02cc5d05

Test 2: Binary data with null bytes
PASS: Binary data returns valid hash: 7bbaa080

Test 3: UTF-8 multibyte string
PASS: UTF-8 string returns valid hash: 263188fd

Test 4: Large string (10KB)
PASS: Large string returns valid hash: 6a640a28

Test 5: String with newlines
PASS: Multiline string returns valid hash: 35acb071

Test 6: Numeric string
PASS: Numeric string returns valid hash: b30d56b4

All edge case tests completed
