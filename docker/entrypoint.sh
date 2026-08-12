#!/bin/bash

# Prüfen, ob Bolt CMS (anhand der composer.json) bereits existiert
if [ ! -f "composer.json" ]; then
    echo "Bolt CMS wird zum ersten Mal heruntergeladen..."

    # In einen temporären Ordner installieren, falls das Verzeichnis nicht komplett leer ist (z.B. wegen .DS_Store auf dem Mac)
    composer create-project bolt/project tmp_bolt --no-interaction

    # Alle Dateien (auch versteckte wie .env) ins eigentliche Verzeichnis verschieben
    shopt -s dotglob
    mv tmp_bolt/* ./
    rm -rf tmp_bolt

    echo "Installation abgeschlossen!"

# Falls die Seite schon existiert, aber der vendor-Ordner fehlt (z.B. nach einem frischen Git Clone)
elif [ ! -d "vendor" ]; then
    echo "Installiere fehlende Abhängigkeiten (vendor)..."
    composer install --no-interaction
fi

# Dateirechte für den Webserver anpassen, damit SQLite schreiben darf
chown -R www-data:www-data var/ public/

# Apache Webserver im Vordergrund starten
echo "Starte Webserver..."
exec apache2-foreground
