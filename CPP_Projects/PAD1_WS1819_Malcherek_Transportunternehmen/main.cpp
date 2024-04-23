#include <iostream>
#include <algorithm>
#include "Fahrtenbuch.h"

void benutzerMenue();
bool hilfsFunktionFahrtAnlegen(Fahrtenbuch &fahrtenbuch, std::vector<Schiff> &schiffe);
bool hilfsFunktionSchiffErfassen(std::vector<Schiff> &schiffe);
bool istSchiffeLeer(std::vector<Schiff> &schiffe);

Schiff schiffErfassen();

int main() {
    benutzerMenue();
    return 0;
}

void benutzerMenue()
{
    Fahrtenbuch fahrtenbuch;
    std::vector<Schiff> schiffe;

    int auswahl = 0;
    do {
        std::cout << "\n1. Fahrt anlegen" << std::endl;
        std::cout << "2. Fahrten ausgeben" << std::endl;
        std::cout << "3. Neues Schiff erfassen" << std::endl;
        std::cout << "4. Umsatzliste ausgeben" << std::endl;
        std::cout << "0. Programm beenden" << std::endl;
        std::cout << "Eingabe:  ";
        std::cin >> auswahl;

        switch (auswahl) {
            case 1:
                if(!istSchiffeLeer(schiffe))
                    hilfsFunktionFahrtAnlegen(fahrtenbuch, schiffe) ?
                    std::cout << "Fahrt wurde angelegt" << std::endl :
                    std::cout << "Fahrt konnte nicht angelegt werden" << std::endl;
                break;
            case 2:
                if(!istSchiffeLeer(schiffe)) fahrtenbuch.fahrtenAusgeben();
                break;
            case 3: {
                if(!hilfsFunktionSchiffErfassen(schiffe))
                    std::cout << "Schiff konnte nicht erfasst werden" << std::endl;
                break;
            }
            case 4: {
                if(!istSchiffeLeer(schiffe)) fahrtenbuch.umsatzlisteAusgeben();
                break;
            }
            case 0:
                break;
            default:
                std::cout << "Ungueltige Eingabe" << std::endl;
        }
    } while (auswahl != 0);
}

bool hilfsFunktionFahrtAnlegen(Fahrtenbuch &fahrtenbuch, std::vector<Schiff> &schiffe)
{
    int schiffAuswahl = -1;
    std::cout << "Welches Schiff (Bitte nur ID Eingeben) ? "; std::cin >> schiffAuswahl;

    // Find the ship using filter
    auto ausgewaehltesSchiff= std::find_if(schiffe.begin(), schiffe.end(), [schiffAuswahl](const Schiff &schiff) {
        return schiffAuswahl == schiff.getId();
    });

    if(ausgewaehltesSchiff == schiffe.end()) {
        std::cout << "Schiff nicht gefunden" << std::endl;
        return false;
    }

    try {
        return fahrtenbuch.fahrtAnlegen(*ausgewaehltesSchiff);
    } catch (std::invalid_argument &e) {
        std::cout << e.what() << std::endl;
        return false;
    }
}

bool hilfsFunktionSchiffErfassen(std::vector<Schiff> &schiffe)
{
    try{
        schiffe.push_back(schiffErfassen());
        return true;
    } catch (std::invalid_argument &e) {
        std::cout << e.what() << std::endl;
        return false;
    }
}

bool istSchiffeLeer(std::vector<Schiff> &schiffe)
{
    if(schiffe.empty()) {
        std::cout << "Keine Schiffe vorhanden" << std::endl;
        return true;
    }

    return false;
}

Schiff schiffErfassen()
{
    std::string name;
    int kapazitaet;
    std::cout << "\nSchiff erfassen: " << std::endl;
    std::cout << "Name: "; std::cin >> name;
    std::cout << "Kapazitaet: "; std::cin >> kapazitaet;
    return {name, kapazitaet};
}