#pragma once

#include "DHT.h"

class Sensors
{
  public:
    const int moisture_sensor_pin;
    const int ldr_pin;
    const int dht_22_pin;
    DHT dht22;
    float moisture_sensor_read;
    float air_humidity_read;
    float air_temperature_read;
    float ldr_read;

  public:
    Sensors(const int msp=0, const int ldrp=0, const int d22p=0);
    ~Sensors();
    void sensors_read();
};