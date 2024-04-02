//
// Created by Vinston Salim
//

#include "Warehouse.h"

#include <cstdlib>
#include <iostream>

Warehouse::Warehouse() {
    // Init storageBins all elements in the array to -1
    for (int & storageBin : storageBins) {
        storageBin = EMPTY_BIN;
    }
}

void Warehouse::goodsReceipt(const int& anzahl) {
    // Check if there is enough space in the warehouse
    if (anzahl > checkFreeSpace()) {
        std::cout << "Nicht genug Lagerplatz vorhanden" << std::endl;
        return;
    }

    for (int i = 0; i < anzahl; i++) {
        // Check material number by id
        int matNumber;
        std::cout << "Bitte geben Sie die Materialnummer ein: ";
        std::cin >> matNumber;

        Material* material = this->getMaterial(matNumber);
        if (material == nullptr) {
            std::cout << "Materialnummer nicht gefunden" << std::endl;
            return;
        }

        // Get a random number between 0 and 839,  Code example from the task
        int randomBin = this->getRandomBin();
        while (true){ // I know this is not the best way to do it, but it is the way the task wants it to be done
            if (storageBins[randomBin] == EMPTY_BIN) {
                storageBins[randomBin] = material->getMatNumber();
                material->changeStock(material->getStock() + 1); // would be better if directly in the material class, but this is what the task wants
                material->addLocation(randomBin);
                std::cout << "Palette eingelagert in Regal " << (randomBin / (FAECHER * ETAGE)) + 1
                          << ", Fach " << (randomBin % (FAECHER * ETAGE)) / ETAGE + 1
                          << ", Ebene " << (randomBin % (FAECHER * ETAGE)) % ETAGE + 1 << std::endl;
                break;
            }
            randomBin = this->getRandomBin();
        }
    }
}

void Warehouse::goodsIssue(const int& anzahl) {
    int occupiedBins = this->getOccupiedBins();

    if(occupiedBins == 0) {
        std::cout << "Kein belegter Lagerplatz gefunden" << std::endl;
        return;
    }

    // Check if there is enough stock in the warehouse
    if (anzahl > occupiedBins) {
        std::cout << "Nicht genug Bestand vorhanden" << std::endl;
        return;
    }

    for(int i = 0; i < anzahl; i++) {
        // Check material number by id
        int matNumber;
        std::cout << "Bitte geben Sie die Materialnummer ein: ";
        std::cin >> matNumber;

        Material* material = this->getMaterial(matNumber);
        if (material == nullptr) {
            std::cout << "Materialnummer nicht gefunden" << std::endl;
            return; // one material not found, so we can stop the whole process
        }

        // Implementation of LIFO
        int lastLocation = material->getLastLocation();

        // Double check if the location is still valid
        if(this->isIndexValid(lastLocation) && (this->storageBins[lastLocation] == material->getMatNumber())) {
            this->storageBins[lastLocation] = EMPTY_BIN;
            material->changeStock(material->getStock() - 1); // would be better if directly in the material class, but this is what the task wants
            material->removeLastLocation();

        } else { // Fallback if the location is not valid
            bool isFound = false;

            for (int j = 0; j < MAX_BINS; j++) {
                if (storageBins[j] == material->getMatNumber()) {
                    lastLocation = j;
                    storageBins[j] = -1;
                    material->changeStock(material->getStock() - 1); // would be better if directly in the material class, but this is what the task wants
                    material->removeLocation(i);
                    isFound = true;
                    break; // because the first found is the one we want to remove
                }
            }

            if (!isFound)
                std::cout << "Palette für Material " << material->getMatText() << " mit Material Nummer" << material->getMatNumber() << " nicht gefunden" << std::endl;
        }

        if(lastLocation != -1) {
            std::cout << "Palette ausgelagert in Regal " << (lastLocation / (FAECHER * ETAGE)) + 1
                      << ", Fach " << (lastLocation % (FAECHER * ETAGE)) / ETAGE + 1
                      << ", Ebene " << (lastLocation % (FAECHER * ETAGE)) % ETAGE + 1 << std::endl;
        }
    }

    std::cout << "Verbleibender Bestand: " << this->getOccupiedBins() << std::endl;
}

int Warehouse::checkFreeSpace() const {
    int freeSpace = 0;
    for (int storageBin : storageBins) {
        if (storageBin == -1) {
            freeSpace++;
        }
    }
    return freeSpace;
}

int Warehouse::getRandomBin() const { // can be static
    // initialize random seed, Code example from the task
    srand(time(NULL));

    return rand() % 840;
}

int Warehouse::getOccupiedBins() const {
    return MAX_BINS - checkFreeSpace();
}

void Warehouse::createMaterial() {
    int matNumber;
    std::string matText;

    std::cout << "Bitte geben Sie die Materialnummer ein: ";
    std::cin >> matNumber;
    std::cout << "Bitte geben Sie die Materialbezeichnung ein: ";
    std::cin >> matText;

    Material tempMaterial = *new Material(matNumber, matText, 0);
    this->materials.push_back(tempMaterial);

    std::cout << "Material " << matText << " mit der Nummer " << matNumber << " wurde angelegt" << std::endl;
}

Material *Warehouse::getMaterial(const int &matNumber) {
    for (auto & material : materials) {
        if (material.getMatNumber() == matNumber) {
            return &material;
        }
    }
    return nullptr;
}

bool Warehouse::isIndexValid(const int &index) const { // can be static
    return index >= 0 && index < MAX_BINS;
}
