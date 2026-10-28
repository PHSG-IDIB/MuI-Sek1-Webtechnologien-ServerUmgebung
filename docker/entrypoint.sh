#!/bin/bash
export COMPOSER_PROCESS_TIMEOUT=2000

# 1. Altlasten aufräumen: Falls ein vorheriger Download abgestürzt ist,
# blockiert der alte tmp_bolt Ordner den Neustart. Daher zuerst löschen.
if [ -d "tmp_bolt" ]; then
    echo "Lösche unvollständigen temporären Ordner von einem vorherigen Versuch..."
    rm -rf tmp_bolt
fi

# 2. Fall: Komplett neue Installation (composer.json fehlt)
if [ ! -f "composer.json" ]; then
    echo "Bolt CMS wird zum ersten Mal heruntergeladen..."

    # Versuche den Download. Das Ausrufezeichen (!) fängt einen Fehler ab.
    if ! composer create-project bolt/project:^6.0 tmp_bolt --no-interaction; then
        echo "FEHLER: Der Download von Bolt CMS ist fehlgeschlagen (evtl. Netzwerkproblem)."
        echo "Räume unvollständige Dateien auf..."
        rm -rf tmp_bolt
        exit 1 # Beendet das Skript mit Fehler, der Container stoppt sichtbar.
    fi

    # Wenn der Download erfolgreich war, kopieren und aufräumen
    shopt -s dotglob
    cp -rn tmp_bolt/* ./
    rm -rf tmp_bolt

    echo "Installation erfolgreich abgeschlossen!"

# 3. Fall: Projekt ist da, aber der vendor-Ordner fehlt oder ist kaputt
# Wir prüfen explizit auf die letzte Datei, die Composer generiert
elif [ ! -f "vendor/autoload_runtime.php" ]; then
    echo "Abhängigkeiten fehlen oder sind unvollständig. Starte Reparatur..."

    # Sicherheitshalber den kaputten Ordner löschen, bevor wir neu anfangen
    rm -rf vendor

    if ! composer install --no-interaction; then
        echo "FEHLER: Installation der Abhängigkeiten fehlgeschlagen."
        echo "Lösche fehlerhaften vendor-Ordner für nächsten Versuch..."
        rm -rf vendor
        exit 1
    fi
fi

# Dateirechte für den Webserver anpassen, damit SQLite schreiben darf
chown -R www-data:www-data /var/www/html

# Apache Webserver im Vordergrund starten
echo "Starte Webserver..."
exec apache2-foreground
