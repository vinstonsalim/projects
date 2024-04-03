# Alte Klausur - Programming 1

This repository contains the solutions for the "Alte Klausur" (Old Exam) for the course "Programming 1" at the University of Applied Sciences Darmstadt (HDA), Department of Computer Science (FBI). The exam was held in the winter semester of 2022/23.

## Structure

The project consists of several C++ files implementing different classes:

- [islandpferd.cpp](islandpferd.cpp) and [islandpferd.h](islandpferd.h)
- [main.cpp](main.cpp)
- [pony.cpp](pony.cpp) and [pony.h](pony.h)
- [ponyhof.cpp](ponyhof.cpp) and [ponyhof.h](ponyhof.h)
- [shetlandpony.cpp](shetlandpony.cpp) and [shetlandpony.h](shetlandpony.h)
- [stall.cpp](stall.cpp) and [stall.h](stall.h)

## Program's Description
This project is a simple simulation of a pony farm, inspired by the saying "life is a pony farm". The program models a pony farm, complete with different types of ponies and their attributes. The ponies are stored in a stable, and the user can interact with the ponies through a menu-driven interface.

The program starts by calculating the number of hooves on the farm using a recursive function. The user can then add ponies to the farm, specifying the breed, name, and birth year of each pony. The ponies are stored in a stable, which can hold a maximum of 20 ponies. The user can also take a pony out for a ride, with the program checking if the pony is suitable for riding based on the rider's age and the pony's breed and temperament.

The program also allows the user to check on the ponies in the stable, displaying information about each pony and the overall state of the stable. The user can see the name, birth year, breed, and other attributes of each pony, as well as the average age of all the ponies in the stable. The program ends by returning all the ponies to their boxes and cleaning up any dynamically allocated memory.


## Building

To build the project, use your preferred C++ compiler and include all the `.cpp` files.

## Running

After building, run the resulting executable to start the program.