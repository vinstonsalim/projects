# Pony Farm - Exam of Programming 1 - WS2223 - Prof. Dr. Yvonne Jung

[![de](https://img.shields.io/badge/lang-de-green.svg)](README.de.md)

## Description

This repository contains the solutions for the "Old Exam" for the course "Programming 1" at the University of Applied Sciences Darmstadt (HDA) by Prof. Dr. Yvonne Jung, Department of Computer Science (FBI). This repository was created when I was working as a teaching assistant for her in the winter semester 2023/2024. The exam itself took place in the winter semester 2022/23, and this program models a pony farm with different types of ponies and their characteristics. The ponies are stored in a stable, and the user can interact with the ponies through a command line interface.

## Structure

The project consists of several C++ files implementing different classes:

- [islandpferd.cpp](islandpferd.cpp) and [islandpferd.h](islandpferd.h)
- [main.cpp](main.cpp)
- [pony.cpp](pony.cpp) and [pony.h](pony.h)
- [ponyhof.cpp](ponyhof.cpp) and [ponyhof.h](ponyhof.h)
- [shetlandpony.cpp](shetlandpony.cpp) and [shetlandpony.h](shetlandpony.h)
- [stall.cpp](stall.cpp) and [stall.h](stall.h)

## Features

This project is a simple simulation of a pony farm, inspired by the saying "life is a pony farm". The program models a pony farm, complete with different types of ponies and their attributes. The ponies are stored in a stable, and the user can interact with the ponies through a menu-driven interface.

The program starts by calculating the number of hooves on the farm using a recursive function. The user can then add ponies to the farm, specifying the breed, name, and birth year of each pony. The ponies are stored in a stable, which can hold a maximum of 20 ponies. The user can also take a pony out for a ride, with the program checking if the pony is suitable for riding based on the rider's age and the pony's breed and temperament.

The program also allows the user to check on the ponies in the stable, displaying information about each pony and the overall state of the stable. The user can see the name, birth year, breed, and other attributes of each pony, as well as the average age of all the ponies in the stable. The program ends by returning all the ponies to their boxes and cleaning up any dynamically allocated memory.

## Usage

To build and run this project, you need to have CMake installed. Then you can directly open it with CLion/QtCreator and run it from there. Alternatively, you can build it manually.

## Lessons Learned

- Learned how to use inheritance in C++
- Learned how to use polymorphism in C++
- Learned how to use dynamic memory allocation in C++
- Learned how to use smart pointers in C++

## Further Improvements if I had more time

- Adding more pony breeds and attributes
- Adding more interactions with the ponies
- Adding more error handling, particularly for user input
- Exporting and Importing the pony farm to and from a csv file
- Adding a graphical user interface (GUI) for the pony farm
