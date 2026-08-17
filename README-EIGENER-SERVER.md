# Los geht's: Dein eigenes Webprojekt starten

Diese Anleitung führt dich durch die ersten Schritte, wie du deine eigene, leere Bolt-Installation einrichtest und mit der Entwicklung deiner Webseite beginnst.

## 1. Umgebung starten

Falls noch nicht geschehen, starte die Docker-Umgebung. Die genaue Anleitung findest du im [README.md](server/beispiel-bolt/README.md).
Deine eigene Webseite findest du unter http://localhost:8080. Aktuell wird dort eine Fehlermeldung erscheinen.

## 2. Administrator-Konto erstellen

Damit du dich im Backend deiner neuen Webseite anmelden kannst, musst du einmalig einen Administrator-Benutzer erstellen.

1. Öffne in Visual Studio Code das integrierte Terminal (im Menü oben unter *Terminal* -> *New Terminal*).
2. Führe folgenden Befehl aus, um die Installation für deinen Arbeitsordner abzuschliessen:
   ```bash
   docker compose exec bolt-web php bin/console bolt:setup
   ```
3. Gehe durch die Installation durch, gib alle angeforderten Daten direkt in der Konsole ein.
4. Das System fragt dich nach einem Benutzernamen, einem Passwort und einer E-Mail-Adresse. Erfasse diese Daten und merke dir insbesondere das Passwort.

## 3. Im Backend anmelden und konfigurieren

1. Öffne deinen Browser und rufe deine lokale Arbeitsumgebung auf: http://localhost:8080/bolt
2. Melde dich mit den Logindaten an, die du gerade im Terminal erstellt hast.

## 4. Programmieren

Nun geht es darum, deine Webseite zu konfigurieren und den Inhalt zu gestalten. Dies geschieht an unterschiedlichen Orten:

- `/server/web/config/bolt/contenttypes.yaml`: Hier erfasst du für deine unterschiedlichen Inhaltsseiten eigene Blöcke, die im Backend ausgefüllt werden.
- `/server/web/config/bolt/menu.yaml`: Hier trägst du die Navigation ein.
- `/server/web/config/bolt/config.yaml`: Hier kannst du die Grundkonfiguration steuern, insbesondere musst du hier dein eigenes **Theme** verlinken.
- `/server/web/public/theme`: Du erstellst hier einen neuen Ordner für dein eigenes **Theme** (den Ordnernamen trägst du im `config.yaml` ein).

In deinem eigenen Theme-Ordner kannst du basierend auf der Vorlage unter [beispiel-bolt/public/theme/mui-webtech](./server/beispiel-bolt/public/theme/mui-webtech)
dein eigenes Theme mit deinen `css`, `js` und `twig`-Dateien erstellen.

Im Backend kannst du nun bei jedem neuen Inhaltstyp selber definieren, welche Twig-Datei für diesen Inhalt verwendet werden soll.

## 5. Laufende Kontrolle

Alle anpassungen im Code (PHPStorm oder VS Code) siehst du nach dem Speichern (passiert automatisch), direkt unter http://localhost:8080 bzw. http://localhost:8080/bolt.
Dazu einfach kurz die Seite neu laden.

## 6. Live-Schaltung (FTP-Upload)

Da dieses Setup eine dateibasierte SQLite-Datenbank verwendet, ist die Live-Schaltung deiner Webseite sehr einfach. Du musst keine Datenbanken ex- und importieren:

1. Öffne ein FTP-Programm (z.B. FileZilla) und verbinde dich mit deinem Live-Server.
2. Navigiere in das Web-Verzeichnis des Servers.
3. Markiere **den gesamten Inhalt** deines Ordners `server/web/`.
4. Lade alle Dateien und Ordner auf den Server hoch.
   *(Achte darauf, dass auch versteckte Dateien wie `.env` und der Ordner `var/data/`, in dem deine Datenbank liegt, hochgeladen werden. Dein Live-Server muss so konfiguriert sein, dass sein DocumentRoot auf den hochgeladenen `public`-Ordner zeigt).*

## 7. Live-Seite

Auf deiner Live-Seite ist deine Webseite nun veröffentlicht. Auch hier kannst du dich im Backend anmelden, die Login-Daten sind gleich: https://xyz.mui-sek1.ch/bolt     
