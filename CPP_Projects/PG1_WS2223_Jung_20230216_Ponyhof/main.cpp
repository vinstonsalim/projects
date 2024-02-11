#include "ponyhof.h"
#include <iostream>

unsigned ponyHufe(unsigned numPonys) {
    // Basisfall: Keine Ponys, daher keine Hufe
    if (numPonys == 0) {
        return 0;
    }
    return ponyHufe(numPonys - 1) + 4;
}

int main()
{
    int numPony = 6;
    std::cout << "numPonys: " << numPony << " , ponyHufe: " << ponyHufe(numPony) << std::endl;

    Ponyhof* myPonyhof = new Ponyhof();
    myPonyhof->userDialog();
    delete myPonyhof;
}


/**
 * Notizen:
 *  Bei Rekursiv : wichtig ist der Zustand wo das rekursive Verhalten stoppt.
 *
 */
