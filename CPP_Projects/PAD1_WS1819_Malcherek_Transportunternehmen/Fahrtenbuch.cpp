#include "Fahrtenbuch.h"

#include <iostream>
#include <unordered_map>
#include <algorithm>

Fahrtenbuch::Fahrtenbuch() = default;

bool Fahrtenbuch::fahrtAnlegen(const Schiff &schiff) {

    try {
        Fahrt tempFahrt = datenErfassen(schiff);

        // Better approach instead of push_back
        fahrten.emplace_back(tempFahrt);
        return true;
    } catch (std::invalid_argument &e) {
        std::cerr << "\nFehler: " << e.what() << std::endl;
        return false;
    }

}

void Fahrtenbuch::fahrtenAusgeben() {
    if (fahrten.empty()) {
        std::cout << "Keine Fahrten vorhanden" << std::endl;
        return;
    }

    for(const auto &fahrt : fahrten) {
        fahrt.ausgeben();
    }
}

// This can be made static
Fahrt Fahrtenbuch::datenErfassen(const Schiff &schiff) {

    std::string abfahrt, ankunft, startOrt, zielOrt;
    int ladung, frachtpreis;


    std::cout << "Abfahrtsdatum im Format JJJJ_MM_TT: ";
    std::cin >> abfahrt;
    std::cout << "Ankunftsdatum im Format JJJJ_MM_TT: ";
    std::cin >> ankunft;

    // Check abfahrt and ankunft not in between any other fahrt
    if(!checkDates(abfahrt, ankunft, schiff))
        throw std::invalid_argument("Schiff " + schiff.getName() + " ist fuer diesen Zeitraum bereits ausgebucht");

    std::cout << "Startort: ";
    std::cin >> startOrt;
    std::cout << "Zielort: ";
    std::cin >> zielOrt;

    std::cout << "Menge: ";
    std::cin >> ladung;
    if(ladung > schiff.getKapazitaet()) {
        throw std::invalid_argument("Ladung ist groesser als die Kapazitaet des Schiffes");
    }

    std::cout << "Frachtpreis: ";
    std::cin >> frachtpreis;

    // using brace initialization
    return {startOrt, zielOrt, abfahrt, ankunft, ladung, frachtpreis, schiff, fahrtNummer++};
}

void Fahrtenbuch::umsatzlisteAusgeben() {
    if (fahrten.empty()) {
        std::cout << "Keine Fahrten vorhanden" << std::endl;
        return;
    }

    std::map<std::string, int> umsatzliste; // To make associative array
    for(const auto &fahrt : fahrten) {
        // If schiff name not in map, add it
        if(umsatzliste.find(fahrt.getSchiffName()) == umsatzliste.end()) {
            umsatzliste[fahrt.getSchiffName()] = 0;
        }
        umsatzliste[fahrt.getSchiffName()] += fahrt.getFrachtpreis();
    }

    std::vector<std::pair<std::string, int>> umsatzlisteSorted = umsatzlisteMapNachDemFrachtpreisSortieren(umsatzliste);

    for(const auto &umsatz : umsatzlisteSorted) {
        std::cout << umsatz.first << "\t\tUmsatz: " << umsatz.second << std::endl;
    }
}

// Helper function can be made static
std::vector<std::pair<std::string, int>> Fahrtenbuch::umsatzlisteMapNachDemFrachtpreisSortieren(std::map<std::string, int> &umsatzliste) {
    std::vector<std::pair<std::string, int>> umsatzlisteVector;

    umsatzlisteVector.reserve(umsatzliste.size());
    for(const auto &umsatz : umsatzliste)
        umsatzlisteVector.emplace_back(umsatz);

    std::sort(umsatzlisteVector.begin(), umsatzlisteVector.end(), [this](const std::pair<std::string, int> &a, const std::pair<std::string, int> &b) {
        return isValueBigger(a, b);
    });

    return umsatzlisteVector;
}

bool Fahrtenbuch::isValueBigger(const std::pair<std::string, int> &a, const std::pair<std::string, int> &b) const {
    return a.second > b.second;
}

bool Fahrtenbuch::checkDates(const std::string &abfahrt, const std::string &ankunft, const Schiff &schiff) {
    // Check if ankfunft before abfahrt
    if(ankunft <= abfahrt) {
        throw std::invalid_argument("Ankunft muss nach Abfahrt liegen");
    }

    // Dateformat is YYYY_MM_DD
    for(const auto &fahrt : fahrten) {
        if(fahrt.getSchiffName() != schiff.getName())
            continue;

        // No old booking inside new booking
        if((abfahrt <= fahrt.getAbfahrt() && ankunft >= fahrt.getAnkunft()) ||
           (abfahrt >= fahrt.getAbfahrt() && abfahrt <= fahrt.getAnkunft()) || // No new booking start inside old booking
           (ankunft >= fahrt.getAbfahrt() && ankunft <= fahrt.getAnkunft())) { // No new booking end inside old booking
            return false;
        }
    }

    return true;
}
