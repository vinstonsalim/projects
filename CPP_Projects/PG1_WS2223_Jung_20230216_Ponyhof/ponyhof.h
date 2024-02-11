#ifndef PONYHOF_H
#define PONYHOF_H

#include "stall.h"
#include <vector>
class Ponyhof
{
private:
    Stall* stallung;
    std::vector<Pony*> beimReiten;
    void feierabend();
    bool ponyAnlegen();
    bool ponyHolen();
    void ponysKontrollieren() const;

public:
    Ponyhof();
    ~Ponyhof();
    void userDialog();
};

#endif // PONYHOF_H
