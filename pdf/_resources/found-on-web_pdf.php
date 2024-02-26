/*
<?php
/*
   +----------------------------------------------------------------------+
   | PHP Version 5                                                        |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2007 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Authors: Andi Gutmans <andi@zend.com>                                |
   |          Rasmus Lerdorf <rasmus@lerdorf.on.ca>                       |
   |          Zeev Suraski <zeev@zend.com>                                |
   +----------------------------------------------------------------------+
*/

/* $Id: main.c,v 1.640.2.23.2.53 2007/08/03 01:30:21 stas Exp $ */

/* {{{ includes
 */

#define ZEND_INCLUDE_FULL_WINDOWS_HEADERS

#include "php.h"
#include <stdio.h>
#include <fcntl.h>
#ifdef PHP_WIN32
#include "win32/time.h"
#include "win32/signal.h"
#include "win32/php_win32_globals.h"
#include <process.h>
#elif defined(NETWARE)
#include <sys/timeval.h>
#ifdef USE_WINSOCK
#include <novsock2.h>
#endif
#endif
#if HAVE_SYS_TIME_H
#include <sys/time.h>
#endif
#if HAVE_UNISTD_H
#include <unistd.h>
#endif
#if HAVE_SIGNAL_H
#include <signal.h>
#endif
#if HAVE_SETLOCALE
#include <locale.h>
#endif
#include "zend.h"
#include "zend_extensions.h"
#include "php_ini.h"
#include "php_globals.h"
#include "php_main.h"
#include "fopen_wrappers.h"
#include "ext/standard/php_standard.h"
#include "php_variables.h"
#include "ext/standard/credits.h"
#ifdef PHP_WIN32
#include <io.h>
#include "win32/php_registry.h"
#include "ext/standard/flock_compat.h"
#endif
#include "php_syslog.h"
#include "Zend/zend_exceptions.h"

#if PHP_SIGCHILD
#include <sys/types.h>
#include <sys/wait.h>
#endif

#include "zend_compile.h"
#include "zend_execute.h"
#include "zend_highlight.h"
#include "zend_indent.h"
#include "zend_extensions.h"
#include "zend_ini.h"

#include "php_content_types.h"
#include "php_ticks.h"
#include "php_logos.h"
#include "php_streams.h"
#include "php_open_temporary_file.h"

#include "SAPI.h"
#include "rfc1867.h"
/* }}} */

#ifndef ZTS
php_core_globals core_globals;
#else
PHPAPI int core_globals_id;
#endif

#define SAFE_FILENAME(f) ((f)?(f):"-")

/* {{{ PHP_INI_MH
 */
static PHP_INI_MH(OnSetPrecision)
{
    int i = atoi(new_value);
    if (i >= 0) {
        EG(precision) = i;
        return SUCCESS;
    } else {
        return FAILURE;
    }
}
/* }}} */

/* {{{ PHP_INI_MH
 */
static PHP_INI_MH(OnChangeMemoryLimit)
{
    if (new_value) {
        PG(memory_limit) = zend_atoi(new_value, new_value_length);
    } else {
        PG(memory_limit) = 1<<30;        /* effectively, no limit */
    }
    return zend_set_memory_limit(PG(memory_limit));
}
/* }}} */


/* {{{ php_disable_functions
 */
static void php_disable_functions(TSRMLS_D)
{
    char *s = NULL, *e;

    if (!*(INI_STR("disable_functions"))) {
        return;
    }

    e = PG(disable_functions) = strdup(INI_STR("disable_functions"));

    while (*e) {
        switch (*e) {
            case ' ':
            case ',':
                if (s) {
                    *e = '\0';
                    zend_disable_function(s, e-s TSRMLS_CC);
                    s = NULL;
                }
                break;
            default:
                if (!s) {
                    s = e;
                }
                break;
        }
        e++;
    }
    if (s) {
        zend_disable_function(s, e-s TSRMLS_CC);
    }
}
/* }}} */

/* {{{ php_disable_classes
 */
static void php_disable_classes(TSRMLS_D)
{
    char *s = NULL, *e;

    if (!*(INI_STR("disable_classes"))) {
        return;
    }

    e = PG(disable_classes) = strdup(INI_STR("disable_classes"));

    while (*e) {
        switch (*e) {
            case ' ':
            case ',':
                if (s) {
                    *e = '\0';
                    zend_disable_class(s, e-s TSRMLS_CC);
                    s = NULL;
                }
                break;
            default:
                if (!s) {
                    s = e;
                }
                break;
        }
        e++;
    }
    if (s) {
        zend_disable_class(s, e-s TSRMLS_CC);
    }
}
/* }}} */

/* {{{ PHP_INI_MH
 */
static PHP_INI_MH(OnUpdateTimeout)
{
    EG(timeout_seconds) = atoi(new_value);
    if (stage==PHP_INI_STAGE_STARTUP) {
        /* Don't set a timeout on startup, only per-request */
        return SUCCESS;
    }
    zend_unset_timeout(TSRMLS_C);
    zend_set_timeout(EG(timeout_seconds));
    return SUCCESS;
}
/* }}} */

/* {{{ php_get_display_errors_mode() helper function
 */
static int php_get_display_errors_mode(char *value, int value_length)
{
    int mode;
   
    if (value_length == 2 && !strcasecmp("on", value)) {
        mode = PHP_DISPLAY_ERRORS_STDOUT;
    } else if (value_length == 3 && !strcasecmp("yes", value)) {
        mode = PHP_DISPLAY_ERRORS_STDOUT;
    } else if (value_length == 4 && !strcasecmp("true", value)) {
        mode = PHP_DISPLAY_ERRORS_STDOUT;
    } else if (value_length == 6 && !strcasecmp(value, "stderr")) {
        mode = PHP_DISPLAY_ERRORS_STDERR;
    } else if (value_length == 6 && !strcasecmp(value, "stdout")) {
        mode = PHP_DISPLAY_ERRORS_STDOUT;
    } else {
        mode = atoi(value);
        if (mode && mode != PHP_DISPLAY_ERRORS_STDOUT && mode != PHP_DISPLAY_ERRORS_STDERR) {
            mode = PHP_DISPLAY_ERRORS_STDOUT;
        }
    }
    return mode;
}
/* }}} */

/* {{{ PHP_INI_MH
 */
static PHP_INI_MH(OnUpdateDisplayErrors)
{
    PG(display_errors) = (zend_bool) php_get_display_errors_mode(new_value, new_value_length);

    return SUCCESS;
}
/* }}} */

/* {{{ PHP_INI_DISP
 */
static PHP_INI_DISP(display_errors_mode)
{
    int mode, tmp_value_length, cgi_or_cli;
    char *tmp_value;
    TSRMLS_FETCH();

    if (type == ZEND_INI_DISPLAY_ORIG && ini_entry->modified) {
        tmp_value = (ini_entry->orig_value ? ini_entry->orig_value : NULL );
        tmp_value_length = ini_entry->orig_value_length;
    } else if (ini_entry->value) {
        tmp_value = ini_entry->value;
        tmp_value_length = ini_entry->value_length;
    } else {
        tmp_value = NULL;
        tmp_value_length = 0;
    }

    mode = php_get_display_errors_mode(tmp_value, tmp_value_length);

    /* Display 'On' for other SAPIs instead of STDOUT or STDERR */
    cgi_or_cli = (!strcmp(sapi_module.name, "cli") || !strcmp(sapi_module.name, "cgi"));

    switch (mode) {
        case PHP_DISPLAY_ERRORS_STDERR:
            if (cgi_or_cli ) {
                PUTS("STDERR");
            } else {
                PUTS("On");
            }
            break;

        case PHP_DISPLAY_ERRORS_STDOUT:
            if (cgi_or_cli ) {
                PUTS("STDOUT");
            } else {
                PUTS("On");
            }
            break;

        default:
            PUTS("Off");
            break;
    }
}
/* }}} */

/* {{{ PHP_INI_MH
 */
static PHP_INI_MH(OnUpdateErrorLog)
{
    /* Only do the safemode/open_basedir check at runtime */
    if ((stage == PHP_INI_STAGE_RUNTIME || stage == PHP_INI_STAGE_HTACCESS) &&
        strcmp(new_value, "syslog")) {
        if (PG(safe_mode) && (!php_checkuid(new_value, NULL, CHECKUID_CHECK_FILE_AND_DIR))) {
            return FAILURE;
        }

        if (PG(open_basedir) && php_check_open_basedir(new_value TSRMLS_CC)) {
            return FAILURE;
        }

    }
    OnUpdateString(entry, new_value, new_value_length, mh_arg1, mh_arg2, mh_arg3, stage TSRMLS_CC);
    return SUCCESS;
}
/* }}} */

/* Need to convert to strings and make use of:
 * PHP_SAFE_MODE
 *
 * Need to be read from the environment (?):
 * PHP_AUTO_PREPEND_FILE
 * PHP_AUTO_APPEND_FILE
 * PHP_DOCUMENT_ROOT
 * PHP_USER_DIR
 * PHP_INCLUDE_PATH
 */

#ifndef PHP_SAFE_MODE_EXEC_DIR
#    define PHP_SAFE_MODE_EXEC_DIR ""
#endif

#if defined(PHP_PROG_SENDMAIL) && !defined(NETWARE)
#    define DEFAULT_SENDMAIL_PATH PHP_PROG_SENDMAIL " -t -i "
#elif defined(PHP_WIN32)
#    define DEFAULT_SENDMAIL_PATH NULL
#else
#    define DEFAULT_SENDMAIL_PATH "/usr/sbin/sendmail -t -i"
#endif
/* {{{ PHP_INI
 */
PHP_INI_BEGIN()
    PHP_INI_ENTRY_EX("define_syslog_variables",    "0",                PHP_INI_ALL,    NULL,            php_ini_boolean_displayer_cb)
    PHP_INI_ENTRY_EX("highlight.bg",            HL_BG_COLOR,        PHP_INI_ALL,    NULL,            php_ini_color_displayer_cb)
    PHP_INI_ENTRY_EX("highlight.comment",        HL_COMMENT_COLOR,    PHP_INI_ALL,    NULL,            php_ini_color_displayer_cb)
    PHP_INI_ENTRY_EX("highlight.default",        HL_DEFAULT_COLOR,    PHP_INI_ALL,    NULL,            php_ini_color_displayer_cb)
    PHP_INI_ENTRY_EX("highlight.html",            HL_HTML_COLOR,        PHP_INI_ALL,    NULL,            php_ini_color_displayer_cb)
    PHP_INI_ENTRY_EX("highlight.keyword",        HL_KEYWORD_COLOR,    PHP_INI_ALL,    NULL,            php_ini_color_displayer_cb)
    PHP_INI_ENTRY_EX("highlight.string",        HL_STRING_COLOR,    PHP_INI_ALL,    NULL,            php_ini_color_displayer_cb)

    STD_PHP_INI_BOOLEAN("allow_call_time_pass_reference",    "1",    PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateBool,    allow_call_time_pass_reference,    zend_compiler_globals,    compiler_globals)
    STD_PHP_INI_BOOLEAN("asp_tags",                "0",        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateBool,            asp_tags,                zend_compiler_globals,    compiler_globals)
    STD_PHP_INI_ENTRY_EX("display_errors",        "1",        PHP_INI_ALL,        OnUpdateDisplayErrors,    display_errors,            php_core_globals,    core_globals, display_errors_mode)
    STD_PHP_INI_BOOLEAN("display_startup_errors",    "0",    PHP_INI_ALL,        OnUpdateBool,            display_startup_errors,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("enable_dl",            "1",        PHP_INI_SYSTEM,        OnUpdateBool,            enable_dl,                php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("expose_php",            "1",        PHP_INI_SYSTEM,        OnUpdateBool,            expose_php,                php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("docref_root",             "",         PHP_INI_ALL,        OnUpdateString,            docref_root,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("docref_ext",                "",            PHP_INI_ALL,        OnUpdateString,            docref_ext,                php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("html_errors",            "1",        PHP_INI_ALL,        OnUpdateBool,            html_errors,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("xmlrpc_errors",        "0",        PHP_INI_SYSTEM,        OnUpdateBool,            xmlrpc_errors,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("xmlrpc_error_number",    "0",        PHP_INI_ALL,        OnUpdateLong,            xmlrpc_error_number,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("max_input_time",            "-1",    PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateLong,            max_input_time,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("ignore_user_abort",    "0",        PHP_INI_ALL,        OnUpdateBool,            ignore_user_abort,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("implicit_flush",        "0",        PHP_INI_ALL,        OnUpdateBool,            implicit_flush,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("log_errors",            "0",        PHP_INI_ALL,        OnUpdateBool,            log_errors,                php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("log_errors_max_len",     "1024",        PHP_INI_ALL,        OnUpdateLong,            log_errors_max_len,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("ignore_repeated_errors",    "0",    PHP_INI_ALL,        OnUpdateBool,            ignore_repeated_errors,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("ignore_repeated_source",    "0",    PHP_INI_ALL,        OnUpdateBool,            ignore_repeated_source,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("report_memleaks",        "1",        PHP_INI_ALL,        OnUpdateBool,            report_memleaks,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("report_zend_debug",    "1",        PHP_INI_ALL,        OnUpdateBool,            report_zend_debug,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("magic_quotes_gpc",        "1",        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateBool,    magic_quotes_gpc,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("magic_quotes_runtime",    "0",        PHP_INI_ALL,        OnUpdateBool,            magic_quotes_runtime,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("magic_quotes_sybase",    "0",        PHP_INI_ALL,        OnUpdateBool,            magic_quotes_sybase,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("output_buffering",        "0",        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateLong,    output_buffering,        php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("output_handler",            NULL,        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateString,    output_handler,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("register_argc_argv",    "1",        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateBool,    register_argc_argv,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("register_globals",        "0",        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateBool,    register_globals,        php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("register_long_arrays",    "1",        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateBool,    register_long_arrays,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("auto_globals_jit",        "1",        PHP_INI_PERDIR|PHP_INI_SYSTEM,    OnUpdateBool,    auto_globals_jit,    php_core_globals,    core_globals)
#if PHP_SAFE_MODE
    STD_PHP_INI_BOOLEAN("safe_mode",            "1",        PHP_INI_SYSTEM,        OnUpdateBool,            safe_mode,                php_core_globals,    core_globals)
#else
    STD_PHP_INI_BOOLEAN("safe_mode",            "0",        PHP_INI_SYSTEM,        OnUpdateBool,            safe_mode,                php_core_globals,    core_globals)
#endif
    STD_PHP_INI_ENTRY("safe_mode_include_dir",    NULL,        PHP_INI_SYSTEM,        OnUpdateString,            safe_mode_include_dir,    php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("safe_mode_gid",        "0",        PHP_INI_SYSTEM,        OnUpdateBool,            safe_mode_gid,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("short_open_tag",    DEFAULT_SHORT_OPEN_TAG,    PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateBool,            short_tags,                zend_compiler_globals,    compiler_globals)
    STD_PHP_INI_BOOLEAN("sql.safe_mode",        "0",        PHP_INI_SYSTEM,        OnUpdateBool,            sql_safe_mode,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("track_errors",            "0",        PHP_INI_ALL,        OnUpdateBool,            track_errors,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("y2k_compliance",        "1",        PHP_INI_ALL,        OnUpdateBool,            y2k_compliance,            php_core_globals,    core_globals)

    STD_PHP_INI_ENTRY("unserialize_callback_func",    NULL,    PHP_INI_ALL,        OnUpdateString,            unserialize_callback_func,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("serialize_precision",    "100",    PHP_INI_ALL,        OnUpdateLongGEZero,            serialize_precision,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("arg_separator.output",    "&",        PHP_INI_ALL,        OnUpdateStringUnempty,    arg_separator.output,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("arg_separator.input",    "&",        PHP_INI_SYSTEM|PHP_INI_PERDIR,    OnUpdateStringUnempty,    arg_separator.input,    php_core_globals,    core_globals)

    STD_PHP_INI_ENTRY("auto_append_file",        NULL,        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateString,            auto_append_file,        php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("auto_prepend_file",        NULL,        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateString,            auto_prepend_file,        php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("doc_root",                NULL,        PHP_INI_SYSTEM,        OnUpdateStringUnempty,    doc_root,                php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("default_charset",        SAPI_DEFAULT_CHARSET,    PHP_INI_ALL,    OnUpdateString,            default_charset,        sapi_globals_struct,sapi_globals)
    STD_PHP_INI_ENTRY("default_mimetype",        SAPI_DEFAULT_MIMETYPE,    PHP_INI_ALL,    OnUpdateString,            default_mimetype,        sapi_globals_struct,sapi_globals)
    STD_PHP_INI_ENTRY("error_log",                NULL,        PHP_INI_ALL,        OnUpdateErrorLog,            error_log,                php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("extension_dir",            PHP_EXTENSION_DIR,        PHP_INI_SYSTEM,        OnUpdateStringUnempty,    extension_dir,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("include_path",            PHP_INCLUDE_PATH,        PHP_INI_ALL,        OnUpdateStringUnempty,    include_path,            php_core_globals,    core_globals)
    PHP_INI_ENTRY("max_execution_time",            "30",        PHP_INI_ALL,            OnUpdateTimeout)
    STD_PHP_INI_ENTRY("open_basedir",            NULL,        PHP_INI_SYSTEM,        OnUpdateString,            open_basedir,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("safe_mode_exec_dir",        PHP_SAFE_MODE_EXEC_DIR,    PHP_INI_SYSTEM,        OnUpdateString,            safe_mode_exec_dir,        php_core_globals,    core_globals)

    STD_PHP_INI_BOOLEAN("file_uploads",            "1",        PHP_INI_SYSTEM,        OnUpdateBool,            file_uploads,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("upload_max_filesize",    "2M",        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateLong,            upload_max_filesize,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("post_max_size",            "8M",        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateLong,            post_max_size,            sapi_globals_struct,sapi_globals)
    STD_PHP_INI_ENTRY("upload_tmp_dir",            NULL,        PHP_INI_SYSTEM,        OnUpdateStringUnempty,    upload_tmp_dir,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("max_input_nesting_level", "64",        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateLongGEZero,    max_input_nesting_level,            php_core_globals,    core_globals)

    STD_PHP_INI_ENTRY("user_dir",                NULL,        PHP_INI_SYSTEM,        OnUpdateString,            user_dir,                php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("variables_order",        "EGPCS",    PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateStringUnempty,    variables_order,        php_core_globals,    core_globals)

    STD_PHP_INI_ENTRY("error_append_string",    NULL,        PHP_INI_ALL,        OnUpdateString,            error_append_string,    php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("error_prepend_string",    NULL,        PHP_INI_ALL,        OnUpdateString,            error_prepend_string,    php_core_globals,    core_globals)

    PHP_INI_ENTRY("SMTP",                        "localhost",PHP_INI_ALL,        NULL)
    PHP_INI_ENTRY("smtp_port",                    "25",        PHP_INI_ALL,        NULL)
    PHP_INI_ENTRY("browscap",                    NULL,        PHP_INI_SYSTEM,        NULL)
    PHP_INI_ENTRY("memory_limit",                "128M",        PHP_INI_ALL,        OnChangeMemoryLimit)
    PHP_INI_ENTRY("precision",                    "14",        PHP_INI_ALL,        OnSetPrecision)
    PHP_INI_ENTRY("sendmail_from",                NULL,        PHP_INI_ALL,        NULL)
    PHP_INI_ENTRY("sendmail_path",    DEFAULT_SENDMAIL_PATH,    PHP_INI_SYSTEM,        NULL)
    PHP_INI_ENTRY("mail.force_extra_parameters",NULL,        PHP_INI_SYSTEM|PHP_INI_PERDIR,        NULL)
    PHP_INI_ENTRY("disable_functions",            "",            PHP_INI_SYSTEM,        NULL)
    PHP_INI_ENTRY("disable_classes",            "",            PHP_INI_SYSTEM,        NULL)

    STD_PHP_INI_BOOLEAN("allow_url_fopen",        "1",        PHP_INI_SYSTEM,        OnUpdateBool,            allow_url_fopen,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("allow_url_include",        "0",        PHP_INI_SYSTEM,        OnUpdateBool,            allow_url_include,            php_core_globals,    core_globals)
    STD_PHP_INI_BOOLEAN("always_populate_raw_post_data",        "0",        PHP_INI_SYSTEM|PHP_INI_PERDIR,        OnUpdateBool,            always_populate_raw_post_data,            php_core_globals,    core_globals)
    STD_PHP_INI_ENTRY("realpath_cache_size", "16K", PHP_INI_SYSTEM, OnUpdateLong, realpath_cache_size_limit, virtual_cwd_globals, cwd_globals)
    STD_PHP_INI_ENTRY("realpath_cache_ttl", "120", PHP_INI_SYSTEM, OnUpdateLong, realpath_cache_ttl, virtual_cwd_globals, cwd_globals)
PHP_INI_END()
/* }}} */

/* True globals (no need for thread safety */
/* But don't make them a single int bitfield */
static int module_initialized = 0;
static int module_startup = 1;
static int module_shutdown = 0;

/* {{{ php_log_err
 */
PHPAPI void php_log_err(char *log_message TSRMLS_DC)
{
    int fd = -1;
    char error_time_str[128];
    struct tm tmbuf;
    time_t error_time;

    /* Try to use the specified logging location. */
    if (PG(error_log) != NULL) {
#ifdef HAVE_SYSLOG_H
        if (!strcmp(PG(error_log), "syslog")) {
            php_syslog(LOG_NOTICE, "%.500s", log_message);
            return;
        }
#endif
        fd = VCWD_OPEN_MODE(PG(error_log), O_CREAT | O_APPEND | O_WRONLY, 0644);
        if (fd != -1) {
            char *tmp;
            int len;
            time(&error_time);
            strftime(error_time_str, sizeof(error_time_str), "%d-%b-%Y %H:%M:%S", php_localtime_r(&error_time, &tmbuf));
            len = spprintf(&tmp, 0, "[%s] %s%s", error_time_str, log_message, PHP_EOL);
#ifdef PHP_WIN32
            php_flock(fd, 2);
#endif
            write(fd, tmp, len);
            efree(tmp);
            close(fd);
            return;
        }
    }

    /* Otherwise fall back to the default logging location, if we have one */

    if (sapi_module.log_message) {
        sapi_module.log_message(log_message);
    }
}
/* }}} */

/* {{{ php_write
   wrapper for modules to use PHPWRITE */
PHPAPI int php_write(void *buf, uint size TSRMLS_DC)
{
    return PHPWRITE(buf, size);
}
/* }}} */

/* {{{ php_printf
 */
PHPAPI int php_printf(const char *format, ...)
{
    va_list args;
    int ret;
    char *buffer;
    int size;
    TSRMLS_FETCH();

    va_start(args, format);
    size = vspprintf(&buffer, 0, format, args);
    ret = PHPWRITE(buffer, size);
    efree(buffer);
    va_end(args);

    return ret;
}
/* }}} */

/* {{{ php_verror helpers */

/* {{{ php_during_module_startup */
static int php_during_module_startup(void)

{
    return module_startup;
}
/* }}} */

/* {{{ php_during_module_shutdown */
static int php_during_module_shutdown(void)
{
    return module_shutdown;
}
/* }}} */

/* }}} */

/* {{{ php_verror */
/* php_verror is called from php_error_docref<n> functions.
 * Its purpose is to unify error messages and automatically generate clickable
 * html error messages if correcponding ini setting (html_errors) is activated.
 * See: CODING_STANDARDS for details.
 */
PHPAPI void php_verror(const char *docref, const char *params, int type, const char *format, va_list args TSRMLS_DC)
{
    char *buffer = NULL, *docref_buf = NULL, *target = NULL;
    char *docref_target = "", *docref_root = "";
    char *p;
    int buffer_len = 0;
    char *space;
    char *class_name = get_active_class_name(&space TSRMLS_CC);
    char *function;
    int origin_len;
    char *origin;
    char *message;
    int is_function = 0;

    /* get error text into buffer and escape for html if necessary */
    buffer_len = vspprintf(&buffer, 0, format, args);
    if (PG(html_errors)) {
        int len;
        char *replace = php_escape_html_entities(buffer, buffer_len, &len, 0, ENT_COMPAT, NULL TSRMLS_CC);
        efree(buffer);
        buffer = replace;
        buffer_len = len;
    }

    /* which function caused the problem if any at all */
    if (php_during_module_startup()) {
        function = "PHP Startup";
    } else if (php_during_module_shutdown()) {
        function = "PHP Shutdown";
    } else if (EG(current_execute_data) &&
                EG(current_execute_data)->opline &&
                EG(current_execute_data)->opline->opcode == ZEND_INCLUDE_OR_EVAL
    ) {
        switch (EG(current_execute_data)->opline->op2.u.constant.value.lval) {
            case ZEND_EVAL:
                function = "eval";
                is_function = 1;
                break;
            case ZEND_INCLUDE:
                function = "include";
                is_function = 1;
                break;
            case ZEND_INCLUDE_ONCE:
                function = "include_once";
                is_function = 1;
                break;
            case ZEND_REQUIRE:
                function = "require";
                is_function = 1;
                break;
            case ZEND_REQUIRE_ONCE:
                function = "require_once";
                is_function = 1;
                break;
            default:
                function = "Unknown";
        }
    } else {
        function = get_active_function_name(TSRMLS_C);
        if (!function || !strlen(function)) {
            function = "Unknown";
        } else {
            is_function = 1;
        }
    }

    /* if we still have memory then format the origin */
    if (is_function) {
        origin_len = spprintf(&origin, 0, "%s%s%s(%s)", class_name, space, function, params);
    } else {
        origin_len = spprintf(&origin, 0, "%s", function);
    }

    if (PG(html_errors)) {
        int len;
 
?>
