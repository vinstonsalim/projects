#ifndef STALL_H
#define STALL_H

#include "pony.h"

#define SIZE 20

class Stall
{
private:
    Pony *pferdeboxen[SIZE];
    int berechneJahr() const;

public:
    Stall();
    ~Stall();
    int belegteBoxen() const;
    bool einstellen(Pony*);
    Pony* herausholen(const std::string&);
    float durchschnittsalter() const;
    void zeigeInfo() const;
};

#endif // STALL_H
