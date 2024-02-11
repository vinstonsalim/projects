#ifndef PONY_H
#define PONY_H

#include <string>
class Pony
{
protected:
    int geburtsJahr;
    std::string name;

public:
    Pony(const int& geburtsJahr, const std::string& name) :
        geburtsJahr(geburtsJahr), name(name) {}
    virtual ~Pony() {}  // Virtual destructor

    virtual std::string gibName() const ;
    virtual int gibGeburtsjahr() const;
    virtual bool istReitbar(const int&) = 0;
    virtual void zeigeInfo() const = 0;
};

#endif // PONY_H
