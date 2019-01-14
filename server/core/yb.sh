#!/bin/sh
PROPATH=/usr/local/nginx/html/yb-job
THISPATH=${PROPATH}/logs
INTERVAL=5
nohup php ${PROPATH}/server/core/ybServer.php >>${THISPATH}/server_script.log 2>&1 & echo $! > ${THISPATH}/server_script.pid
while [ 1 ]; do
    if [ ! -d /proc/`cat ${THISPATH}/server_script.pid` ]; then
        nohup php ${PROPATH}/server/core/ybServer.php >>${THISPATH}/server_script.log 2>&1 & echo $! > ${THISPATH}/server_script.pid
        echo 'NEW_PID:'`cat ${THISPATH}/server_script.pid && date '+%Y-%m-%d %H:%M:%S'`
    fi
    sleep ${INTERVAL}
done
