cmake_minimum_required(VERSION 3.27)
project(PAD1_WS1819_Malcherek_Transportunternehmen)

set(CMAKE_CXX_STANDARD 14)

include_directories(.)

add_executable(PAD1_WS1819_Malcherek_Transportunternehmen
        Schiff.cpp
        Schiff.h
        Fahrt.h
        Fahrt.cpp
        Fahrtenbuch.cpp
        Fahrtenbuch.h
        main.cpp)
