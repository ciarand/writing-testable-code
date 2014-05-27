#!/bin/bash

while true; do
    inotifywait -e modify,close_write,moved_to,move,create,delete -qq **/*.php \
        && clear \
        && ./vendor/bin/phpunit

    if [ $? -eq 0 ]
    then
        true
        #notify-send -i non-starred "Test status" "All tests passed"
    else
        notify-send -i stop "Test status" "Some tests failed"
    fi
done
