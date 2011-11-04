# Dokumentation

## Servervoraussetzungen

* Webserver mit Rewrite-Engine, welcher vom Zend Framework unterstütz wird
	* Empfehlung: Apache 2 mit mod_rewrite
* php 5.3
* SQL-Datenbanksystem, welches vom Doctrine Projekt unterstützt wird
	* Empfehlung: MySQL
* SMTP-Account für E-Mail-Benachtigungen
* Apache Ant

## Installation

1. Dateien auf Webserver kopieren
1. DocumentRoot auf Ordner "public" setzten
1. Datenbank und Zugangsdaten im Datenbanksystem anlegen
1. "application/configs/application.ini" anpassen, siehe TODO-Makierungen
	* Datenbanksystem konfigurieren
	* SMTP-Account konfigurieren
1. "ant init" im obersten Projektordner ausführen
	* Rechte im Dateisystem werden gesetzt
	* es wird ein Account mit Login "admin@example.com" und Password "password" angelegt
	* die Kontaktinformationen werden mit Dummydaten befüllt
1. über "www.newsroom-domain.com/admin" kann sich nun mit "admin@example.com" eingeloggt werden

## Konfiguration
* Nutzer ändern und neue Nutzer anlegen
* Kontaktinformationen richtig setzen
