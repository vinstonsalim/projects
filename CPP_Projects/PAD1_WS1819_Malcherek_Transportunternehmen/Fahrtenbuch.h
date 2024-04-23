#ifndef PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_FAHRTENBUCH_H
#define PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_FAHRTENBUCH_H

#include "Fahrt.h"

#include <vector>
#include <map>

class Fahrtenbuch {

private:
    std::vector<Fahrt> fahrten;
    Fahrt datenErfassen(const Schiff &schiff);
    int fahrtNummer = 1; // start at 1
    bool checkDates(const std::string &abfahrt, const std::string &ankunft, const Schiff &schiff);
    std::vector<std::pair<std::string, int>> umsatzlisteMapNachDemFrachtpreisSortieren(std::map<std::string, int> &umsatzliste);
    bool isValueBigger(const std::pair<std::string, int> &a, const std::pair<std::string, int> &b) const;

public:
    Fahrtenbuch();
    bool fahrtAnlegen(const Schiff& schiff);
    void fahrtenAusgeben();
    void umsatzlisteAusgeben();

};


#endif //PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_FAHRTENBUCH_H
