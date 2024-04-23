#include "Schiff.h"

#include <iostream>

Schiff::Schiff(std::string name, const int &kapazitaet, const int &schiffNummer):
    name(std::move(name)), kapazitaet(kapazitaet), schiffNummer(schiffNummer)
{
    // No Name Check Because it is not in the task, and it is not necessary because the ID is unique
    std::cout << "Schiff: " << this->name << " mit ID: " << this->schiffNummer << " wurde angelegt" << std::endl;
}

int Schiff::getKapazitaet() const {
    return this->kapazitaet;
}

int Schiff::getId() const {
    return this->schiffNummer;
}

std::string Schiff::getName() const {
    return this->name;
}