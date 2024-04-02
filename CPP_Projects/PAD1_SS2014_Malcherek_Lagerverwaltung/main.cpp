#include <iostream>
#include "Warehouse.h"

void benutzerMenue();

int main() {
    benutzerMenue();
    return 0;
}

void benutzerMenue() {
    Warehouse lager = Warehouse();
    int userSelectedOption;

    do {
        std::cout << "1. Wareneingang buchen" << std::endl;
        std::cout << "2. Warenausgang buchen" << std::endl;
        std::cout << "3. Material anlegen" << std::endl;
        std::cout << "0. Programm beenden" << std::endl;
        std::cout << "Bitte waehlen Sie eine Option aus: ";
        std::cin >> userSelectedOption;
        int anzahl = 0;
        switch (userSelectedOption) {
            case 1:
                std::cout << "Wie viele Paletten sollen eingelagert werden? ";
                std::cin >> anzahl;
                lager.goodsReceipt(anzahl); // should be a check for the input, but not in the task
                break;
            case 2:
                std::cout << "Wie viele Paletten sollen ausgelagert werden? ";
                std::cin >> anzahl;
                lager.goodsIssue(anzahl); // should be a check for the input, but not in the task
                break;
            case 3:
                lager.createMaterial();
                break;
            case 0:
                break;
            default:
                std::cout << "Ungueltige Eingabe" << std::endl;
        }
    } while (userSelectedOption != 0);

}