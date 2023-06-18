#pragma once

class Actuators
{
  public:
    const int motor_1_pin;
    const int motor_2_pin;
    const int water_pump_pin;
    const int incandescent_lamp_pin;
    const int plant_led_pin;

  public:
    Actuators(const int m1p=0, const int m2p=0, const int wpp=0, const int il=0, const int pl=0);
    ~Actuators();
};
