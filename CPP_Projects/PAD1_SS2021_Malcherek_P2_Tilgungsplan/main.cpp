#include <iostream>
#include <iomanip>

#define KREDITSUMME 10000.0
#define ZINSSATZ 0.07


int main()
{
    int jahr{0};
    double annuitaet, zinsen, tilgung{0}, restschuld;

    std::cout << "Geben Sie bitte die gewuenschte Annuitaet ein: ";
    std::cin >> annuitaet;

    while(annuitaet <= KREDITSUMME * ZINSSATZ){
        std::cout << "Die Annuitaet muss groesser als 700 EUR\n";
        std::cout << "Geben Sie bitte die gewuenschte Annuitaet ein: ";
        std::cin >> annuitaet;
    }

    restschuld = KREDITSUMME;

    while(restschuld > 0){
        zinsen = ZINSSATZ * restschuld;

        if(restschuld > tilgung){
            tilgung = annuitaet - zinsen;
        } else {
            tilgung = restschuld;
        }

        restschuld -= tilgung;

        std::cout << std::left << "Jahr: " << std::setw(10) << ++jahr
                  << "Zinsen: " << std::setw(9) << zinsen << "EUR\t"
                  << "Tilgung: " << std::setw(9) << tilgung << " EUR\t"
                  << "Restschuld: " << std::setw(10) << restschuld << " EUR" << std::endl;
    }

    return 0;
}
