#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "horde_xxhash.h"

/* xxhash */
#include "xxhash.h"

/* Generated arginfo */
#include "xxhash_arginfo.h"

/* Constants */
#define XXHASH_HEX_LENGTH 8

zend_module_entry horde_xxhash_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
    STANDARD_MODULE_HEADER,
#endif
    "horde_xxhash",
    ext_functions,
    NULL,
    NULL,
    NULL,
    NULL,
    PHP_MINFO(horde_xxhash),
#if ZEND_MODULE_API_NO >= 20010901
    HORDE_XXHASH_EXT_VERSION,
#endif
    STANDARD_MODULE_PROPERTIES};

#ifdef COMPILE_DL_HORDE_XXHASH
ZEND_GET_MODULE(horde_xxhash)
#endif

PHP_MINFO_FUNCTION(horde_xxhash) {
    php_info_print_table_start();
    php_info_print_table_row(2, "Horde xxHash support", "enabled");
    php_info_print_table_row(2, "Extension Version", HORDE_XXHASH_EXT_VERSION);
    php_info_print_table_end();
}

#if PHP_MAJOR_VERSION < 7

PHP_FUNCTION(horde_xxhash) {
    char *data;
    char *hash = emalloc(XXHASH_HEX_LENGTH + 1);
    unsigned int data_len;

    if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &data,
                              &data_len) == FAILURE) {
        RETURN_FALSE;
    }

    sprintf(hash, "%08x", XXH32(data, data_len, 0));

    RETURN_STRINGL(hash, XXHASH_HEX_LENGTH, 0);
}

#else

PHP_FUNCTION(horde_xxhash) {
    zend_string *data = NULL;
    zend_string *hash;

    ZEND_PARSE_PARAMETERS_START(1, 1)
        Z_PARAM_STR(data)
    ZEND_PARSE_PARAMETERS_END();

    if (ZSTR_LEN(data) > INT_MAX) {
        zend_argument_value_error(1, "input data exceeds maximum size");
        RETURN_THROWS();
    }

    hash = strpprintf(XXHASH_HEX_LENGTH, "%08x",
                      XXH32(ZSTR_VAL(data), (int)ZSTR_LEN(data), 0));

    RETURN_STR(hash);
}

#endif
