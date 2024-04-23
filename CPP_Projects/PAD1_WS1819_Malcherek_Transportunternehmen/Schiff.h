#ifndef PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_SCHIFF_H
#define PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_SCHIFF_H

#include <string>

static int SCHIFF_NUMMER_COUNTER = 1;

class Schiff {

private:
    std::string name;
    const int kapazitaet;
    const int schiffNummer;

public:
    Schiff(std::string name, const int& kapazitaet, const int& schiffNummer = SCHIFF_NUMMER_COUNTER++);

    int getKapazitaet() const;
    int getId() const;
    std::string getName() const;
};


#endif //PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_SCHIFF_H
