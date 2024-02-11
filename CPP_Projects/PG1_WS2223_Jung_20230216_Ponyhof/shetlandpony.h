#ifndef SHETLANDPONY_H
#define SHETLANDPONY_H

#include "pony.h"
class Shetlandpony : public Pony
{
private:
    bool kinderlieb;

public:
    Shetlandpony(
        const int& geburtsJahr,
        const std::string& name,
        const bool& kinderlieb) :
        Pony(geburtsJahr, name), kinderlieb(kinderlieb) {}

    bool istKeinderlieb() const;
    bool istReitbar(const int&);
    void zeigeInfo() const;

};

#endif // SHETLANDPONY_H
