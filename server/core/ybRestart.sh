echo "Flashing"
PID=$(pidof php_yb_job_server)
kill -USR1 "$PID"
echo "Flash SUCCESS"