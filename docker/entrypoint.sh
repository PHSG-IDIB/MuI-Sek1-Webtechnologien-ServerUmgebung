#!/bin/bash

echo "entrypoint.sh: server startet und wird konfiguriert."

if [ -d "/tmp/vendor_host" ] && [ "$(ls -A /tmp/vendor_host 2>/dev/null)" ]; then
    echo "Kopiere Vendor-Dateien in das interne Volume..."
    cp -a /tmp/vendor_host/. /var/www/html/vendor/
fi

# Dateirechte für den Webserver anpassen, damit SQLite schreiben darf
chown -R www-data:www-data /var/www/html

# Apache Webserver im Vordergrund starten
echo "Starte Webserver..."
exec apache2-foreground
