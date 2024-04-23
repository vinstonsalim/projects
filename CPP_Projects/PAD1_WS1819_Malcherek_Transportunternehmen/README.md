# Shipping Company Logbook - Exam of PAD1 - Winter Semester 2018/2019 - Prof. Dr. Arnim Malcherek

[![de](https://img.shields.io/badge/lang-de-green.svg)](README.de.md)

## Description

This project is basically a pratical exam from Prof. Dr. Arnim Malcherek for the Programming, Algorithm, and Data Structure 1 (PAD1) course in the winter semester 2018/2019. The task was to implement a simple program for a shipping company. The program should be able to create a logbook for trips and output a revenue list. The program should also be able to create ships and assign them to trips.

## Structure

- [`Fahrt.cpp`](Fahrt.cpp) and [`Fahrt.h`](Fahrt.h): These files define the `Fahrt` class, which represents a single trip.
- [`Fahrtenbuch.cpp`](Fahrtenbuch.cpp) and [`Fahrtenbuch.h`](Fahrtenbuch.h): These files define the `Fahrtenbuch` class, which represents the logbook. It includes methods for creating a trip, outputting trips, and outputting a revenue list.
- [`main.cpp`](main.cpp): This file contains the main function and helper functions for user interaction.
- [`Schiff.cpp`](Schiff.cpp) and [`Schiff.h`](Schiff.h): These files define the `Schiff` class, which represents a ship.

## Features

- Create a new trip with a chosen ship
- Create a new ship
- Print out all trips in the logbook
- Print out a revenue list basen on the ships name and the revenue

## Usage

To build and run this project, you need to have CMake installed. Then you can directly open it with CLion and run it from there. Alternatively, you can build it manually.

## Lessons Learned

- Learned how man can be used to build a associative array
- Learned how to use lambda functions
- Learned how to use list initialization
- Learned how to use the `auto` keyword

## Further Improvements if I had more time

- Adding more error handling particularly for user input
- Enable to user to add multiple trips the same ship in one go
- Enable the user to add multiple ships in one go
- Enable to add trip with the same ship and same date and the same destination
- Enable the user to delete trips
- Enable the user to delete ships
- Enable the user to edit trips
- Enable the user to edit ships
- Enable the user to save and load the logbook to and from a file
- Enable the user to save and load the ships to and from a file
