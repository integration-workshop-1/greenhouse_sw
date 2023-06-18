#pragma once

#include <HTTPClient.h>
#include"sensors.h"
#include"wifi.h"

class ServerESP32
{
  private:
    const char* server_address;
    const char* db_response_address;
    const char* manual_address;
    const char* automatic_address;
    String api_key_value;
    HTTPClient http_client;
    Sensors* sensors;
    Wifi* wifi;
    float soil_moisture_base;
    float temperature_base;

  public:
    ServerESP32(const char* sa="", const char* dra="", const char* ma="", const char* aa="", const String akv="", Sensors* s=NULL, Wifi* w=NULL);
    ~ServerESP32();
    const int http_response();
    void manual_mode();
    void automatic_mode();
    void server_injection();
    const float get_soil_moisture_base();
    const float get_temperature_base();
};