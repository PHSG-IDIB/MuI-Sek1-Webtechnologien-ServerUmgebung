# Modul Webtechnologien - Docker Entwicklungsumgebung

Dieses Repository enthält eine vorkonfigurierte lokale Entwicklungsumgebung für das [Bolt CMS](https://boltcms.io/) sowie zwei Beispielprojekte.
Mithilfe von Docker wird automatisch ein lokaler Webserver inklusive PHP und SQLite-Datenbank gestartet,
ohne dass komplizierte lokale Installationen notwendig sind.

## 1. Voraussetzungen

<details>
<summary><strong>Anleitung für Mac</strong></summary>

1. Lade [Docker Desktop für Mac](https://www.docker.com/products/docker-desktop) herunter. Achte darauf, die passende Version für deinen Chip ("Mac mit Intel-Chip" oder "Mac mit Apple-Chip") zu wählen.
2. Installiere das Programm und starte es.
3. Gewähre Docker beim ersten Start die nötigen Berechtigungen. Das Programm muss fortlaufend im Hintergrund laufen (sichtbar oben in der Menüleiste).
</details>

<details>
<summary><strong>Anleitung für Windows</strong></summary>

1. Installiere [Docker Desktop für Windows](https://www.docker.com/products/docker-desktop).
2. **Wichtig:** Stelle sicher, dass WSL 2 (Windows Subsystem for Linux) bei der Installation aktiviert ist, da Docker darunter am effizientesten läuft.
3. Starte Docker Desktop, sodass es im Hintergrund läuft (sichtbar unten rechts in der Taskleiste).
</details>

## 2. Erster Start der Umgebung

Die Umgebung kann direkt aus deiner bevorzugten Entwicklungsumgebung (IDE) gestartet werden. Du benötigst kein Terminal.

<details>
<summary><strong>Start mit Visual Studio Code</strong></summary>

1. Öffne den gesamten heruntergeladenen Projektordner in VS Code.
2. Gehe zu den Erweiterungen und installiere (falls nicht bereits vorhanden) die offizielle Erweiterung **"Docker"** von Microsoft.
3. Suche im Datei-Explorer (linke Seitenleiste) die Datei `docker-compose.yml`.
4. Mache einen **Rechtsklick** auf diese Datei und wähle **Compose Up**.
</details>

<details>
<summary><strong>Start mit PHPStorm</strong></summary>

1. Öffne den gesamten heruntergeladenen Projektordner in PHPStorm.
2. Öffne den Projektbaum auf der linken Seite.
3. Mache einen **Rechtsklick** auf die Datei `docker-compose.yml`.
4. Wähle im Kontextmenü **Run 'Docker'**. (PHPStorm hat die Docker-Unterstützung in der Regel bereits integriert. Alternativ öffnet sich unten der "Services"-Tab, in dem du die Container starten und überwachen kannst).
</details>

*Hinweis beim ersten Start: Docker lädt nun alle benötigten Werkzeuge herunter und installiert das Bolt CMS vollautomatisch. Dieser Vorgang kann beim allerersten Mal 1 bis 2 Minuten dauern.*

## 3. Aufbau und Erreichbarkeit

Das Projekt ist in drei Bereiche unterteilt. Jeder Bereich hat intern einen eigenen `public`-Ordner. Dieser Ordner stellt sicher, dass der Webserver genau dort startet und keine internen Konfigurationsdateien (wie z.B. Datenbanken oder Passwörter) versehentlich von aussen aufgerufen werden können.

Sobald die Container laufen, kannst du die Projekte unter folgenden Adressen in deinem Browser aufrufen:

* **Deine eigene Webseite:** [http://localhost:8080](http://localhost:8080)
    * *Ordner:* `server/web/`
    * Hier programmierst du deine Lösung. Die Einstiegsdatei liegt in `server/web/public/`.
* **Beispiel 1 (Bolt CMS):** [http://localhost:8081](http://localhost:8081)
    * *Ordner:* `server/beispiel-bolt/`
    * Eine vorbereitete Bolt-Webseite als Referenz.
* **Beispiel 2 (HTML/CSS):** [http://localhost:8082](http://localhost:8082)
    * *Ordner:* `server/beispiel-html/`
    * Eine einfache, statische HTML-Seite mit Bootstrap als Anschauungsmaterial.

## 4. Entwicklung

Jedes Mal, wenn du eine Datei in deiner IDE speicherst, wird die Änderung sofort aktiv. Lade einfach die Seite in deinem Browser neu.
Die Bolt-Umgebung ist bereits im Hintergrund vorkonfiguriert, damit der Cache automatisch geleert wird und Änderungen ohne Verzögerung sichtbar werden.

## 5. Umgebung beenden

Wenn du mit der Arbeit fertig bist, solltest du den lokalen Server beenden, um Ressourcen auf deinem Computer zu sparen:

* **Visual Studio Code:** Rechtsklick auf `docker-compose.yml` -> **Compose Down**
* **PHPStorm:** Im "Services"-Tab unten den laufenden Container stoppen oder Rechtsklick auf die `docker-compose.yml` -> **Stop**

## 6. Live-Schaltung (FTP-Upload)

Da dieses Setup eine dateibasierte SQLite-Datenbank verwendet, ist die Live-Schaltung deiner Webseite sehr einfach. Du musst keine Datenbanken ex- und importieren:

1. Öffne ein FTP-Programm (z.B. FileZilla) und verbinde dich mit deinem Live-Server.
2. Navigiere in das Web-Verzeichnis des Servers.
3. Markiere **den gesamten Inhalt** deines Ordners `server/web/`.
4. Lade alle Dateien und Ordner auf den Server hoch.
   *(Achte darauf, dass auch versteckte Dateien wie `.env` und der Ordner `var/data/`, in dem deine Datenbank liegt, hochgeladen werden. Dein Live-Server muss so konfiguriert sein, dass sein DocumentRoot auf den hochgeladenen `public`-Ordner zeigt).*

---

## Lizenz & Weiternutzung

Dieses didaktische Setup und die dazugehörigen Dokumentationen wurden von Beat Temperli erstellt.

Das gesamte Repository als didaktisches Setup ist lizenziert unter der **CC BY-NC-SA 4.0**. Der Programmcode an sich steht unter der GPLv3-Lizenz.

Das bedeutet: Du darfst das Material für Unterrichtszwecke frei verwenden, anpassen und weitergeben, solange du den Urheber nennst, es nicht für kommerzielle Produkte verwendest und daraus entstandene Werke unter denselben Bedingungen veröffentlichst. Weitere Details zur Lizenz findest du bei [creativecommons.org](https://creativecommons.org/licenses/by-nc-sa/4.0/deed.de).
