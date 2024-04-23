# Ponyhof - Alte Klausur Programmierung 1 - WS2223 - Prof. Dr. Jung

[![en](https://img.shields.io/badge/lang-en-green.svg)](README.md)

## Beschreibung

Dieses Repository enthält die Lösungen für die "Alte Klausur" für den Kurs "Programmierung 1" an der Hochschule Darmstadt (HDA) von Prof. Dr. Yvonne Jung, Fachbereich Informatik (FBI), dieses Repository wurde erstellt als ich bei ihr als Tutor tätig im Wintersemester 2023/2024 war. Die Prüfung fand im Wintersemester 2022/23 statt und dieses Programm modelliert einen Ponyhof mit verschiedenen Arten von Ponys und deren Eigenschaften. Die Ponys werden in einem Stall gespeichert, und der Benutzer kann mit den Ponys über eine menügesteuerte Schnittstelle interagieren.

## Struktur

Das Projekt besteht aus mehreren C++-Dateien, die verschiedene Klassen implementieren:

- [islandpferd.cpp](islandpferd.cpp) und [islandpferd.h](islandpferd.h)
- [main.cpp](main.cpp)
- [pony.cpp](pony.cpp) und [pony.h](pony.h)
- [ponyhof.cpp](ponyhof.cpp) und [ponyhof.h](ponyhof.h)
- [shetlandpony.cpp](shetlandpony.cpp) und [shetlandpony.h](shetlandpony.h)
- [stall.cpp](stall.cpp) und [stall.h](stall.h)

## Funktionen

Das Programm beginnt damit, die Anzahl der Hufe auf dem Hof mithilfe einer rekursiven Funktion zu berechnen. Der Benutzer kann dann Ponys zum Hof hinzufügen und dabei die Rasse, den Namen und das Geburtsjahr jedes Ponys angeben. Die Ponys werden in einem Stall gespeichert, der maximal 20 Ponys aufnehmen kann. Der Benutzer kann auch ein Pony für einen Ausritt mitnehmen, wobei das Programm überprüft, ob das Pony zum Reiten geeignet ist, basierend auf dem Alter des Reiters, der Rasse des Ponys und seinem Temperament.

Das Programm ermöglicht es dem Benutzer auch, die Ponys im Stall zu überprüfen, wobei Informationen zu jedem Pony und zum allgemeinen Zustand des Stalls angezeigt werden. Der Benutzer kann den Namen, das Geburtsjahr, die Rasse und andere Attribute jedes Ponys sowie das durchschnittliche Alter aller Ponys im Stall sehen. Das Programm endet damit, dass alle Ponys zurück in ihre Boxen gebracht und alle dynamisch allokierten Speicher freigegeben werden.

## Verwendung

Um dieses Projekt zu erstellen und auszuführen, müssen Sie CMake installiert haben. Anschließend können Sie es direkt mit CLion/QtCreator öffnen und von dort ausführen. Alternativ können Sie es manuell erstellen.

## Erkenntnisse

- Gelernt, wie Vererbung in C++ verwendet werden kann
- Gelernt, wie Polymorphismus in C++ verwendet werden kann
- Gelernt, wie dynamische Speicherzuweisung in C++ verwendet werden kann
- Gelernt, wie Smart Pointer in C++ verwendet werden können

## Weitere Verbesserungen, wenn ich mehr Zeit hätte

- Hinzufügen weiterer Ponyrassen und -attribute
- Hinzufügen weiterer Interaktionen mit den Ponys
- Hinzufügen weiterer Fehlerbehandlung, insbesondere für Benutzereingaben
- Exportieren und Importieren des Ponyhofs in und aus einer CSV-Datei
- Hinzufügen einer grafischen Benutzeroberfläche (GUI) für den Ponyhof mit QtGUI
