#include "islandpferd.h"
#include <iostream>

bool Islandpferd::hatEkzem() const
{
    return this->ekzemer;
}

bool Islandpferd::istReitbar(const int &alter)
{
    return alter >= 10;
}

void Islandpferd::zeigeInfo() const
{
    std::cout << "Name: " << this->name
              << ", Geboren: " << this->geburtsJahr << " , Ekzemer: "
              << ((this->ekzemer) ? "Ja" : "Nein")
              << ", Rasse: Islandpferd." << std::endl;
}
