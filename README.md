# Horde xxhash Extension for PHP #

This extension allows for hashing via the xxHash algorithm.

Documentation for xxHash can be found at [» http://code.google.com/p/xxhash/](http://code.google.com/p/xxhash/).

## Purpose

This extension is maintained for educational purposes only.
horde/xxhash used to tie into horde/lz4 for supporting the xxhash algorithm.
Modern PHP 8 brings its own xxhash methods in core and horde/lz4 is going to be ported to this core functionality.

Making horde/xxhash compatible with latest PHP 8.x practices is a _toy project_ and learning experience. It serves no practical purposes.
I last contributed c code patches to PHP many years ago and mostly learned from Sara Golemon's seminal book on PHP Interals "Extending and Embedding PHP", published in 2006. I am also not the original author, neither of xxhash nor of horde/xxhash and in no way affiliated with the original PHP implementation.

You want to use this for some reason? Great! Let me know, I am curious!

## Configration ##

php.ini:

    extension=horde_xxhash.so

## Function ##

* horde\_xxhash — xxHash computation

### horde\_xxhash — xxHash computation ###

#### Description ####

string **horde\_xxhash** (string _$data_)

xxHash computation.

#### Pameters ####

* _data_

  The string to hash.

#### Return Values ####

Returns the 32-bit hash value (in hexidecimal), or FALSE if an error occurred.


## Examples ##

    $hash = horde_xxhash('test');
