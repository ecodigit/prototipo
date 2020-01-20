#!/bin/sh

cd `dirname $0`
cd ..

echo 'Watching on changes...'
while true; do ./vendor/phing/phing/bin/phing -S; sleep .5; done
