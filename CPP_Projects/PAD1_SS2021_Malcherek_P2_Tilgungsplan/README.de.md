# Tilgungsplan für Darlehen

[![en](https://img.shields.io/badge/lang-en-green.svg)](README.md)

## Beschreibung

Dieses C++-Programm berechnet den Tilgungsplan für ein Darlehen mit einem festen Zinssatz. Es fordert den Benutzer auf, die gewünschte Annuität (monatliche Zahlung) einzugeben, und berechnet dann iterativ und zeigt die Aufschlüsselung jeder Zahlung in Zinsen, Tilgung und verbleibenden Darlehensbetrag, bis das Darlehen vollständig zurückgezahlt ist. Dieses Programmm basiert auf der Praktikumsaufgabe des 2. Praktikums im Modul "Programmieren und Datenstrukturen 1" an der Hochschule Darmstadt (HDA) von Prof. Dr. Arnim Malcherek.

## Programmlogik

1. Das Programm verwendet vordefinierte Konstanten für das Darlehenskapital (`KREDITSUMME`) und den Zinssatz (`ZINSSATZ`).
2. Es fordert den Benutzer auf, die gewünschte Annuität einzugeben.
3. Wenn die Annuität kleiner oder gleich den auf das Darlehenskapital für den ersten Zahlungszeitraum aufgelaufenen Zinsen ist, fordert es den Benutzer auf, eine höhere Annuität einzugeben.
4. Es initialisiert Variablen für den Jahreszähler (`jahr`), die Annuität, Zinsen, Tilgung und den verbleibenden Darlehensbetrag (`restschuld`).
5. Es durchläuft jeden Zahlungszeitraum und berechnet die Zinsen, Tilgung und aktualisiert den verbleibenden Darlehensbetrag, bis der Betrag Null ist.
6. Bei jeder Iteration werden das Jahr, die Zinsen, die Tilgung und der verbleibende Darlehensbetrag in tabellarischer Form ausgegeben.

## Anwendung

1. Kompilieren Sie das Programm mit einem C++-Compiler (z. B. g++).
2. Führen Sie die kompilierte ausführbare Datei aus.
3. Geben Sie die gewünschte Annuität ein, wenn Sie dazu aufgefordert werden.
4. Sehen Sie sich den generierten Tilgungsplan an, der die Aufschlüsselung der Zahlungen und den verbleibenden Darlehensbetrag zeigt.

## Hinweise

- Das Programm geht von einem festen Zinssatz aus und berücksichtigt keine zusätzlichen Faktoren wie Gebühren oder Änderungen der Zinssätze im Laufe der Zeit.
- Stellen Sie sicher, dass Sie einen gültigen Annuitätsbetrag eingeben, der größer ist als das Minimum, das erforderlich ist, um die für den ersten Zahlungszeitraum angefallenen Zinsen zu decken.
