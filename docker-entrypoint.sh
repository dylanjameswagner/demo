#!/bin/bash
rm -f /var/run/apache2/apache2.pid
/usr/sbin/apachectl -k graceful
tail -f /var/log/apache2/*