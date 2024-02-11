#ifndef ISLANDPFERD_H
#define ISLANDPFERD_H

#include "pony.h"
class Islandpferd : public Pony
{
private:
    bool ekzemer;

public:
    Islandpferd(
        const int& geburtsJahr,
        const std::string& name,
        const bool& hatEkzem) :
        Pony(geburtsJahr, name), ekzemer(hatEkzem) {}
    virtual ~Islandpferd() {};

    bool hatEkzem() const;
    bool istReitbar(const int&);
    void zeigeInfo() const;
};

#endif // ISLANDPFERD_H
