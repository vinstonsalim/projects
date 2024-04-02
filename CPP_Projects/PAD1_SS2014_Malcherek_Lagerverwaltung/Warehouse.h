//
// Created by Vinston Salim
//

#ifndef PAD1_SS2014_MALCHEREK_LAGERVERWALTUNG_WAREHOUSE_H
#define PAD1_SS2014_MALCHEREK_LAGERVERWALTUNG_WAREHOUSE_H


#include "Material.h"
#include "const.cpp"

#include <vector>


class Warehouse {

private:
    static const int MAX_BINS = REGALE * FAECHER * ETAGE;
    int storageBins[MAX_BINS]{};
    std::vector<Material> materials;

    // Helper functions
    [[nodiscard]] int checkFreeSpace() const;
    [[nodiscard]] int getRandomBin() const;
    [[nodiscard]] int getOccupiedBins() const;
    Material* getMaterial(const int& matNumber);
    bool isIndexValid(const int& index) const;

public:
    Warehouse();
    void goodsReceipt(const int& anzahl);
    void goodsIssue(const int& anzahl);
    void createMaterial();
};


#endif //PAD1_SS2014_MALCHEREK_LAGERVERWALTUNG_WAREHOUSE_H
