#ifndef PHP_HORDE_XXHASH_H
#define PHP_HORDE_XXHASH_H

extern zend_module_entry horde_xxhash_module_entry;
#define phpext_horde_xxhash_ptr &horde_xxhash_module_entry

/* Auto-updated by scripts/sync-version.sh from .horde.yml during build.
 * Do not manually edit this version - it will be overwritten. */
#define HORDE_XXHASH_EXT_VERSION "3.0.0"

#ifdef PHP_WIN32
#define PHP_HORDE_XXHASH_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#define PHP_HORDE_XXHASH_API __attribute__((visibility("default")))
#else
#define PHP_HORDE_XXHASH_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_MINFO_FUNCTION(horde_xxhash);

PHP_FUNCTION(horde_xxhash);

#endif /* PHP_HORDE_XXHASH_H */
