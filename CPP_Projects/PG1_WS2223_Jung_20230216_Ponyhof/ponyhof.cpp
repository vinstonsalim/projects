#include "ponyhof.h"
#include "islandpferd.h"
#include "shetlandpony.h"
#include <iostream>

Ponyhof::Ponyhof() {
    this->stallung = new Stall();
}

Ponyhof::~Ponyhof()
{
    this->stallung->~Stall();
}

void Ponyhof::userDialog()
{
    int eingabe;
    do {
        std::cout << "1\tPony einstellen" << std::endl;
        std::cout << "2\tPony zum Reiten holen" << std::endl;
        std::cout << "3\tPonys kontrollieren" << std::endl;
        std::cout << "0\tPony beenden" << std::endl;

        std::cout << "User Eingabe: ";
        std::cin >> eingabe;

        switch (eingabe) {

        case 0: {
            this->feierabend();
            std::cout << "Programm endet ... " << std::endl;
            return;
        }

        case 1: {
            if(this->ponyAnlegen()) std::cout << "Pony wurde eingefuegt" << std::endl;
            else std::cout << "Fehler beim Anlegen" << std::endl;
            break;
        }
        case 2: {
            if(this->ponyHolen()) std::cout << "Ponny wird geritten" << std::endl;
            break;
        }
        case 3: {
            this->ponysKontrollieren();
            break;
        }
        default: {
            std::cout << "Ungueltige Eingabe, bitte wiederholen" << std::endl;
            break;
        }
        }


    } while(eingabe!=0);
}

bool Ponyhof::ponyAnlegen()
{
    if(this->stallung->belegteBoxen() == SIZE) {
        std::cout << "Box Voll !!!" << std::endl;
        return false;
    }
    int rasse;
    std::cout << "Welche Rasse soll eingestellt werden? (0 fuer Isi,  1 fuer Shetty) : ";
    std::cin >> rasse;

    // Unvalid Rasse
    if(rasse != 0 && rasse !=1) {
        std::cerr << "Unvalide Eingabe bei Rasse" << std::endl;
        return false;
    }

    int geburtsJahr;
    std::cout << "Geburstjahr: ";
    std::cin >> geburtsJahr;

    std::string name;
    std::cout << "Name: ";
    std::cin >> name;

    bool boolEingabe;
    std::string eingabe;
    std::string frage = (rasse) ? "Kinderlieb" : "Ekzemer";

    std::cout << frage << " [y/n]: ";
    std::cin >> eingabe;

    if(eingabe != "y" && eingabe != "n") {
        std::cout << "Unvalide Eingabe bei" << frage << std::endl;
        return false;
    }

    boolEingabe = (eingabe == "y") ? true : false;

    Pony* pony = nullptr;

    // Create Instance Of Classe
    if(rasse)
        pony = new Shetlandpony(geburtsJahr, name, boolEingabe);
    else
        pony = new Islandpferd(geburtsJahr, name, boolEingabe);

    return this->stallung->einstellen(pony);
}

bool Ponyhof::ponyHolen() {
    // Guard
    if(this->stallung->belegteBoxen() == 0) {
        std::cerr << "Kein Pferd in der Stallung" << std::endl;
        return false;
    }

    std::string name;
    int alterDesReiters;

    std::cout << "Name des zu holenden Ponys: ";
    std::cin >> name;

    Pony* ponyZumReiten =  this->stallung->herausholen(name);

    if(ponyZumReiten == nullptr) {
        std::cerr << "Kein Pferd mit dem Namen " << name << " gefunden!" << std::endl;
        return false;
    }

    std::cout << "Alter des Reiters: ";
    std::cin >> alterDesReiters;

    if(!ponyZumReiten->istReitbar(alterDesReiters)) {
        std::cerr << "Ponny nicht reitbar" << std::endl;
        this->stallung->einstellen(ponyZumReiten);
        return false;
    }

    Shetlandpony* shetlandpony = dynamic_cast<Shetlandpony*>(ponyZumReiten);
    if(shetlandpony != nullptr && alterDesReiters <= 8) {
        if(!shetlandpony->istKeinderlieb()) {
            std::cerr << "Ponny nicht kinderlieb" << std::endl;
            this->stallung->einstellen(ponyZumReiten);
            return false;
        }
    }

    this->beimReiten.push_back(ponyZumReiten);
    return true;
}

void Ponyhof::ponysKontrollieren() const{
    this->stallung->zeigeInfo();
    std::cout << "Ponys beim Reiten: " << this->beimReiten.size() << std::endl;
}

void Ponyhof::feierabend()
{
    // Reiten.size() != 0
    while(this->beimReiten.size())
    {
        this->stallung->einstellen(this->beimReiten[0]);
        this->beimReiten.erase(this->beimReiten.begin()); // Pop front
    }
}


