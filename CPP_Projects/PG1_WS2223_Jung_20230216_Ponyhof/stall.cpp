#include "stall.h"
#include <ctime>
#include <iostream>

Stall::Stall()
{
    for(int i = 0; i < 20; i++)
        this->pferdeboxen[i]=nullptr;
}

Stall::~Stall()
{
    for(int i = 0; i < 20; i++)
        if(this->pferdeboxen[i] != nullptr)
            delete this->pferdeboxen[i];
}

int Stall::belegteBoxen() const
{
    int counter = 0;
    for(int i = 0; i < 20; i++)
        if(this->pferdeboxen[i] != nullptr)
            counter++;

    return counter;
}

bool Stall::einstellen(Pony* pony)
{
    for(int i = 0; i < 20; i++) {
        if(this->pferdeboxen[i] == nullptr) {
            this->pferdeboxen[i] = pony;
            return true;
        }
    }

    return false;
}

Pony* Stall::herausholen(const std::string &name)
{
    Pony* result = nullptr;

    for(int i = 0; i < 20; i++) {
        if(this->pferdeboxen[i] != nullptr) {
            if(this->pferdeboxen[i]->gibName() == name) {
                result = this->pferdeboxen[i];
                this->pferdeboxen[i] = nullptr;
                break;
            }
        }
    }

    return result;
}

float Stall::durchschnittsalter() const
{
    int totalPferde = 0, alterSumme=0, berechnerJahr = this->berechneJahr();
    for(int i = 0; i < 20; i++) {
        if(this->pferdeboxen[i] != nullptr) {
            totalPferde++;
            alterSumme += (berechnerJahr - this->pferdeboxen[i]->gibGeburtsjahr());
        }
    }

    return float(float(alterSumme)/float(totalPferde));
}

void Stall::zeigeInfo() const
{
    if(this->belegteBoxen() == 0) {
        std::cout << "Kein Pferd in Stall" << std::endl;
        return;
    }

    std::cout << "Durchschnittsalter: " << this->durchschnittsalter() << std::endl;

    for(int i = 0; i < 20; i++)
        if(this->pferdeboxen[i] != nullptr)
            this->pferdeboxen[i]->zeigeInfo();
}

int Stall::berechneJahr() const
{
    std::time_t seconds = time(NULL);
    return 1970 + static_cast<int>(seconds / (365.25 * 24 * 60 * 60));
}

