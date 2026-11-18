#!/bin/bash

echo "entrypoint.sh: server startet und wird konfiguriert."

# Dateirechte für den Webserver anpassen, damit SQLite schreiben darf
chown -R www-data:www-data /var/www/html

# Apache Webserver im Vordergrund starten
echo "Starte Webserver..."
exec apache2-foreground
