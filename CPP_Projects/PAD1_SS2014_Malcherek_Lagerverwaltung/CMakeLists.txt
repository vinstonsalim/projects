cmake_minimum_required(VERSION 3.27)
project(PAD1_SS2014_Malcherek_Lagerverwaltung)

set(CMAKE_CXX_STANDARD 11)

add_executable(PAD1_SS2014_Malcherek_Lagerverwaltung main.cpp
        Material.cpp
        Material.h
        Warehouse.cpp
        Warehouse.h
        const.cpp)
