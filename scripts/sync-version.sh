#!/bin/bash
# Update version in header from .horde.yml
# Run this before phpize/configure

set -e

HORDE_YML=".horde.yml"
HEADER_FILE="horde_xxhash.h"

if [ ! -f "$HORDE_YML" ]; then
    echo "Error: $HORDE_YML not found"
    exit 1
fi

if [ ! -f "$HEADER_FILE" ]; then
    echo "Error: $HEADER_FILE not found"
    exit 1
fi

# Extract version from .horde.yml
# Format: "release: 3.0.0-dev" or "release: 3.0.0"
VERSION=$(grep -A 1 "^version:" "$HORDE_YML" | grep "release:" | sed 's/.*release: *\([^ ]*\).*/\1/' | sed 's/-dev//')

if [ -z "$VERSION" ]; then
    echo "Error: Could not extract version from $HORDE_YML"
    exit 1
fi

echo "Extracted version: $VERSION"

# Update header file
sed -i "s/#define HORDE_XXHASH_EXT_VERSION \".*\"/#define HORDE_XXHASH_EXT_VERSION \"$VERSION\"/" "$HEADER_FILE"

echo "Updated $HEADER_FILE with version $VERSION"

# Show the change
grep "HORDE_XXHASH_EXT_VERSION" "$HEADER_FILE"
