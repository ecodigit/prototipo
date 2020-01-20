#!/bin/sh

cd `dirname $0`
cd ..

cd dist/public_html
php -S localhost:$1
