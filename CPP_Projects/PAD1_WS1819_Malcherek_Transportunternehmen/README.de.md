# Transportunternehmen - Alte Klausur PAD1 - WS1819 - Prof. Dr. Malcherek

[![en](https://img.shields.io/badge/lang-de-green.svg)](README.md)

## Beschreibung

Dieses Projekt war eine praktische Prüfung von Prof. Dr. Malcherek für den Kurs Programmieren, Algorithmen und Datenstrukturen 1 im Wintersemester 2018/2019. Die Aufgabe bestand darin, ein einfaches Programm für die Verwaltung eines Transportunternehmens zu erstellen. Das Programm sollte in der Lage sein, Fahrten zu verwalten, Schiffe zu verwalten und eine Umsatzliste zu erstellen. Die Fahrten sollten in einem Tagebuch gespeichert werden, das in einer Klasse implementiert werden sollte. Die Schiffe sollten ebenfalls in einer Klasse implementiert werden. Die Umsatzliste sollte basierend auf dem Schiffsnamen und dem Umsatz erstellt werden.

## Struktur

- [`Fahrt.cpp`](Fahrt.cpp) und [`Fahrt.h`](Fahrt.h): Diese Dateien definieren die Klasse `Fahrt`, die eine einzelne Fahrt repräsentiert.
- [`Fahrtenbuch.cpp`](Fahrtenbuch.cpp) und [`Fahrtenbuch.h`](Fahrtenbuch.h): Diese Dateien definieren die Klasse `Fahrtenbuch`, die das Tagebuch repräsentiert. Sie enthält Methoden zum Erstellen einer Fahrt, zum Ausgeben von Fahrten und zum Ausgeben einer Umsatzliste.
- [`main.cpp`](main.cpp): Diese Datei enthält die Hauptfunktion und Hilfsfunktionen für die Benutzerinteraktion.
- [`Schiff.cpp`](Schiff.cpp) und [`Schiff.h`](Schiff.h): Diese Dateien definieren die Klasse `Schiff`, die ein Schiff repräsentiert.

## Funktionen

- Eine neue Fahrt mit einem ausgewählten Schiff erstellen
- Ein neues Schiff erstellen
- Alle Fahrten im Tagebuch ausgeben
- Eine Umsatzliste basierend auf dem Schiffsnamen und dem Umsatz ausgeben

## Verwendung

Um dieses Projekt zu erstellen und auszuführen, müssen Sie CMake installiert haben. Anschließend können Sie es direkt mit CLion/QtCreator öffnen und von dort ausführen. Alternativ können Sie es manuell erstellen.

## Lessons Learned

- Gelernt, wie `map` verwendet werden kann, um ein assoziatives Array abzubilden
- Gelernt, wie man Lambda-Funktionen verwendet
- Gelernt, wie man Listeninitialisierung verwendet
- Gelernt, wie man das `auto`-Schlüsselwort verwendet

## Weitere Verbesserungen, wenn ich mehr Zeit hätte

- Hinzufügen einer weiteren Fehlerbehandlung, insbesondere für Benutzereingaben
- Benutzer in der Lage machen, mehrere Fahrten mit demselben Schiff auf einmal hinzuzufügen
- Benutzer in der Lage machen, mehrere Schiffe auf einmal hinzuzufügen
- Hinzufügen einer Funktion, um Fahrten mit demselben Schiff und am selben Datum und zum selben Ziel hinzuzufügen
- Benutzer in der Lage machen, Fahrten zu löschen
- Benutzer in der Lage machen, Schiffe zu löschen
- Benutzer in der Lage machen, Fahrten zu bearbeiten
- Benutzer in der Lage machen, Schiffe zu bearbeiten
- Benutzer in der Lage machen, das Tagebuch in eine Datei zu speichern und daraus zu laden
- Benutzer in der Lage machen, die Schiffe in eine Datei zu speichern und daraus zu laden
