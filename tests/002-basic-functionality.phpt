--TEST--
horde_xxhash() basic functionality with known test vectors
--SKIPIF--
<?php
if (!extension_loaded('horde_xxhash')) {
    die('skip horde_xxhash extension not available');
}
?>
--FILE--
<?php
// Test known hash values
$tests = [
    '123'  => 'b6855437',
    '1234' => '01543429',
    'ABC'  => '80712ed5',
    'ABCD' => 'aa960ca6',
];

echo "Testing known hash values:\n";
$passed = 0;
$failed = 0;

foreach ($tests as $input => $expected) {
    $result = horde_xxhash($input);
    if ($result === $expected) {
        echo "PASS: horde_xxhash('$input') = $result\n";
        $passed++;
    } else {
        echo "FAIL: horde_xxhash('$input') = $result (expected $expected)\n";
        $failed++;
    }
}

echo "\nResults: $passed passed, $failed failed\n";

// Test consistency (same input = same output)
echo "\nTesting consistency:\n";
$input = 'test_string';
$hash1 = horde_xxhash($input);
$hash2 = horde_xxhash($input);
if ($hash1 === $hash2) {
    echo "PASS: Consistent hash for '$input'\n";
} else {
    echo "FAIL: Inconsistent hash: $hash1 vs $hash2\n";
}

// Test output format (8 hex characters)
echo "\nTesting output format:\n";
if (preg_match('/^[0-9a-f]{8}$/', $hash1)) {
    echo "PASS: Hash format is 8 hex characters\n";
} else {
    echo "FAIL: Invalid hash format: $hash1\n";
}

echo "\nAll tests completed\n";
?>
--EXPECT--
Testing known hash values:
PASS: horde_xxhash('123') = b6855437
PASS: horde_xxhash('1234') = 01543429
PASS: horde_xxhash('ABC') = 80712ed5
PASS: horde_xxhash('ABCD') = aa960ca6

Results: 4 passed, 0 failed

Testing consistency:
PASS: Consistent hash for 'test_string'

Testing output format:
PASS: Hash format is 8 hex characters

All tests completed
