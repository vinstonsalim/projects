# Lagerverwaltungssystem - Alte Klausur PAD1 - Sommersemester 2014 - Prof. Dr. Arnim Malcherek

[![en](https://img.shields.io/badge/lang-en-green.svg)](README.md)

## Beschreibung

Dieses Repository enthält die Lösungen für die "Alte Klausur" für den Kurs "Programmieren, Algorithmen, und Datenstrukturen 1" an der Hochschule Darmstadt (HDA) von Prof. Dr. Malcherek, Fachbereich Informatik (FBI). Die Prüfung fand im Sommersemester 2014 statt. Das Lagerverwaltungssystem ist darauf ausgelegt, die Lagerung und Entnahme von Materialien in einem Lagerumfeld zu handhaben. Es ermöglicht Benutzern, Lagerbestände zu verwalten, Warenempfänge zu buchen und Warenausgaben effizient zu bearbeiten.

## Struktur

- [`Material.cpp`](Material.cpp) und [`Material.h`](Material.h): Diese Dateien definieren die Klasse `Material`, die ein Material mit einer eindeutigen Kennung und Beschreibung repräsentiert.
- [`Warehouse.cpp`](Warehouse.cpp) und [`Warehouse.h`](Warehouse.h): Diese Dateien definieren die Klasse `Warehouse`, die das Lager mit mehreren Regalen, Fächern und Ebenen repräsentiert.
- [`WarehouseManagementSystem.cpp`](WarehouseManagementSystem.cpp) und [`WarehouseManagementSystem.h`](WarehouseManagementSystem.h): Diese Dateien definieren die Klasse `WarehouseManagementSystem`, die die Benutzeroberfläche für die Interaktion mit dem System bereitstellt.
- [`main.cpp`](main.cpp): Diese Datei enthält die Hauptfunktion und Hilfsfunktionen für die Benutzerinteraktion.
- [`CMakeLists.txt`](CMakeLists.txt): Diese Datei enthält die CMake-Konfiguration für den Projektbau.

## Funktionen

- **Initialisierung von Materialien:** Das System startet mit einem Materialtyp im Lager, identifiziert durch Materialnummer und Beschreibung.
- **Lagerkonfiguration:** Das Lager besteht aus mehreren Regalen, Fächern und Ebenen und bietet insgesamt 840 Lagerplätze.
- **Benutzeroberfläche:** Benutzer interagieren mit dem System über eine einfache Menüoberfläche, die Aktionen wie das Buchen von Wareneingängen und -ausgängen ermöglicht.
- **Zufällige Zuteilung:** Waren werden aus zufälligen freien Lagerplätzen im Lager eingelagert und entnommen.
- **Dynamisches Bestandsmanagement:** Benutzer können jede Menge Paletten für Wareneingänge und -ausgänge verwalten und so eine effiziente Bestandsverwaltung gewährleisten.
- **Materialerstellung:** Das System unterstützt die Erstellung mehrerer Materialien, jeweils mit einer eigenen eindeutigen Kennung und Beschreibung.
- **LIFO-Strategie:** Eine Last-In-First-Out-Strategie für Warenausgänge wurde implementiert, um eine effiziente Materialbearbeitung sicherzustellen.

## Verwendung

Um das Lagerverwaltungssystem zu nutzen:

1. Initialisieren Sie das System mit dem bereitgestellten Material.
2. Greifen Sie auf die Benutzeroberfläche zu, um Wareneingänge oder -ausgänge zu buchen.
3. Verwalten Sie mehrere Materialien und ihren Bestand effizient.
4. Nutzen Sie die LIFO-Strategie für eine optimale Warenbearbeitung.

## Erkenntnisse

- Gelernt, wie man ein Lagerverwaltungssystem entwirft und implementiert.
- Erfahrungen im Umgang mit Bestandsverwaltung und Materialbearbeitung gesammelt.
- Verständnis für die Bedeutung effizienter Lagerungs- und Entnahmestrategien erlangt.
- Gelernt, wie man die LILO-Strategie für Warenausgänge implementiert.

## Weitere Verbesserungen, wenn ich mehr Zeit hätte

- Fehlerbehandlung für ungültige Benutzereingaben hinzufügen.
- Einbinden einer Datenbank zur dauerhaften Speicherung von Material- und Bestandsdaten.
- Importieren und Exportieren der Lagerdaten in und aus einer CSV-Datei.
- Hinzufügen einer grafischen Benutzeroberfläche (GUI) für das Lagerverwaltungssystem zur Verbesserung der Benutzererfahrung mit QtGUI.
