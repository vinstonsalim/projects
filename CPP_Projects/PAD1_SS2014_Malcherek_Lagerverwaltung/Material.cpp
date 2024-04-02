//
// Created by Vinston Salim
//

#include "Material.h"

Material::Material(const int& matNumber, std::string  matText, const int& stock):
        matNumber(matNumber), matText(std::move(matText)), stock(stock)
{

}

int Material::getMatNumber() const {
    return this->matNumber;
}

std::string Material::getMatText() const {
    return this->matText;
}

int Material::getStock() const {
    return this->stock;
}

void Material::changeStock(const int &newStock) {
    this->stock = newStock;
}

void Material::addLocation(const int &location) {
    this->locations.push_back(location);
}

void Material::removeLastLocation(){
    this->locations.pop_back();
}

void Material::removeLocation(const int &location) {
    for (int i = 0; i < this->locations.size(); i++) {
        if (this->locations[i] == location) {
            this->locations.erase(this->locations.begin() + i);
            break;
        }
    }
}

int Material::getLastLocation() const {
    return !this->locations.empty() ? this->locations.back() : -1;
}