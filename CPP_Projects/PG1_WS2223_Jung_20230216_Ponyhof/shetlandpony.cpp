#include "shetlandpony.h"
#include <iostream>

bool Shetlandpony::istKeinderlieb() const
{
    return this->kinderlieb;
}

bool Shetlandpony::istReitbar(const int &alter)
{
    return alter >= 5 && alter <= 12;
}

void Shetlandpony::zeigeInfo() const
{
    std::cout << "Name: " << this->name
              << ", Geboren: " << this->geburtsJahr << " , Kinderlieb: "
              << ((this->kinderlieb) ? "Ja" : "Nein")
              << ", Rasse: Shetlandpony." << std::endl;
}
