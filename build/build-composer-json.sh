#!/bin/bash

_REALDIRPATH="`dirname $0`"
COMPOSERSOURCE="${_REALDIRPATH}/composer.json.build"
COMPOSERTARGET="${_REALDIRPATH}/../composer.json"

#sed -e '/^#/d' $COMPOSERSOURCE | more
sed -e '/^#/d' $COMPOSERSOURCE > $COMPOSERTARGET && \
    echo "OK - 'composer.json' is rebuilt" && exit 0 || \
    echo "ERROR - can not rebuild 'composer.json'!" && exit 1;

exit 0
