//
// Created by Vinston Salim
//

#ifndef PAD1_SS2014_MALCHEREK_LAGERVERWALTUNG_MATERIAL_H
#define PAD1_SS2014_MALCHEREK_LAGERVERWALTUNG_MATERIAL_H

#include <string>
#include <vector>

class Material {

private:

    int matNumber;
    int stock;
    std::string matText;
    std::vector<int> locations;

public:
    Material(const int& matNumber, std::string matText, const int& stock);
    [[nodiscard]] int getMatNumber() const;
    [[nodiscard]] std::string getMatText() const;
    [[nodiscard]] int getStock() const;
    void changeStock(const int& newStock);
    void addLocation(const int& location);
    void removeLastLocation();
    void removeLocation(const int& location);
    int getLastLocation() const;

};


#endif //PAD1_SS2014_MALCHEREK_LAGERVERWALTUNG_MATERIAL_H
