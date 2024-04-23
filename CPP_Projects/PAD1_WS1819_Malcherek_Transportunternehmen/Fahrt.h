#ifndef PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_FAHRT_H
#define PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_FAHRT_H

#include "Schiff.h"

class Fahrt {

private:
    std::string startOrt;
    std::string zielOrt;
    std::string abfahrt;
    std::string ankunft;
    int ladung;
    int frachtpreis;
    Schiff schiff;
    int fahrtNummer;

public:
    Fahrt(std::string startOrt,
          std::string zielOrt,
          std::string abfahrt,
          std::string ankunft,
          const int &ladung,
          const int &frachtpreis,
          Schiff schiff,
          const int &fahrtNummer);

    void ausgeben() const;
    std::string getAbfahrt() const;
    std::string getAnkunft() const;
    std::string getSchiffName() const;
    int getFrachtpreis() const;
};


#endif //PAD1_WS1819_MALCHEREK_TRANSPORTUNTERNEHMEN_FAHRT_H
