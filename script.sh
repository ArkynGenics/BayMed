#!/bin/bash
service apache2 start
service mariadb start
#tail ini just in case docker container
#keluar setelah menjalankan main process
#untuk mencegahny
tail -f /dev/null