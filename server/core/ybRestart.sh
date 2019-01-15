echo "Flashing"
PID=$(pidof php_yb_job_server)
kill -9 $PID
echo "Flash SUCCESS"