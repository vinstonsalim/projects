#include "Fahrt.h"

#include <utility>
#include <iostream>

Fahrt::Fahrt(std::string startOrt, std::string zielOrt, std::string abfahrt,
             std::string ankunft, const int &ladung, const int &frachtpreis, Schiff schiff, const int &fahrtNummer)
             :
             startOrt(std::move(startOrt)),
             zielOrt(std::move(zielOrt)),
             abfahrt(std::move(abfahrt)),
             ankunft(std::move(ankunft)),
             ladung(ladung),
             frachtpreis(frachtpreis),
             schiff(std::move(schiff)),
             fahrtNummer(fahrtNummer)
{

}

void Fahrt::ausgeben() const {
    std::cout
    << "Fahrt: " << fahrtNummer
    << " : " << this->schiff.getName()
    << " von " << startOrt
    << ", " << abfahrt
    << " nach " << zielOrt
    << ", " << ankunft
    << ", Preis: " << frachtpreis
    << std::endl;
}

std::string Fahrt::getAbfahrt() const {
    return this->abfahrt;
}

std::string Fahrt::getAnkunft() const {
    return this->ankunft;
}

std::string Fahrt::getSchiffName() const {
    return this->schiff.getName();
}

int Fahrt::getFrachtpreis() const {
    return this->frachtpreis;
}
