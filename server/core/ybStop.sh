echo "Stopping"
YBPID=$(pgrep -f yb.sh)
PID=$(pidof php_yb_job_server)
kill -9 $YBPID
kill -9 $PID
echo "Stop Success"
