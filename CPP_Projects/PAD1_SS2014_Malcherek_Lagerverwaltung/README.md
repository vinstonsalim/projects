# Warehouse Management System - Exam of PAD1 - Summer Semester 2014 - Prof. Dr. Malcherek

[![de](https://img.shields.io/badge/lang-de-green.svg)](README.de.md)

## Description

This repository contains the solutions for the "Old Exam" for the course "Programming, Algorithms, and Data Structures 1" at the University of Applied Sciences Darmstadt (HDA) by Prof. Dr. Malcherek, Department of Computer Science (FBI). The exam took place in the summer semester of 2014. The warehouse management system is designed to handle the storage and retrieval of materials in a warehouse management system. It allows users to manage inventory, book goods receipts, and process goods issues efficiently.

## Structure

- [`Material.cpp`](Material.cpp) and [`Material.h`](Material.h): These files define the `Material` class, which represents a material with a unique identifier and description.
- [`Warehouse.cpp`](Warehouse.cpp) and [`Warehouse.h`](Warehouse.h): These files define the `Warehouse` class, which represents the warehouse with multiple shelves, compartments, and levels.
- [`WarehouseManagementSystem.cpp`](WarehouseManagementSystem.cpp) and [`WarehouseManagementSystem.h`](WarehouseManagementSystem.h): These files define the `WarehouseManagementSystem` class, which provides the user interface for interacting with the system.
- [`main.cpp`](main.cpp): This file contains the main function and helper functions for user interaction.
- [`CMakeLists.txt`](CMakeLists.txt): This file contains the CMake configuration for building the project.

## Features

- **Material Initialization:** The system initializes with one type of material in the warehouse, identified by material number and description.
- **Warehouse Configuration:** The warehouse consists of multiple shelves, compartments, and levels, providing a total of 840 storage spaces.
- **User Interface:** Users interact with the system through a simple menu interface, enabling actions such as booking goods receipts and issues.
- **Random Allocation:** Goods are stored and retrieved from random free storage spaces within the warehouse.
- **Dynamic Inventory Management:** Users can handle any quantity of pallets for goods receipts and issues, ensuring efficient inventory management.
- **Material Creation:** The system supports the creation of multiple materials, each with its own unique identifier and description.
- **LIFO Strategy:** Implemented a Last-In-First-Out strategy for goods issues, ensuring efficient material handling.

## Usage

To utilize the Warehouse Management System:

1. Initialize the system with the provided material.
2. Access the user interface to book goods receipts or issues.
3. Manage multiple materials and their inventory efficiently.
4. Utilize the LIFO strategy for optimal goods handling.

## Lessons Learned

- Learned how to design and implement a warehouse management system.
- Gained experience in managing inventory and material handling.
- Understood the importance of efficient storage and retrieval strategies.
- Learned how to implement LILO strategy for goods issues.

## Further Improvements if I had more time

- Add error handling for invalid user inputs.
- Integrate a database for persistent storage of material and inventory data.
- Immporting and exporting the warehouse data to and from a csv file.
- Adding a graphical user interface (GUI) for the warehouse management system to improve user experience with QtGUI.
