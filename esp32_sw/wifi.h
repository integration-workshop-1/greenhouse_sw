#pragma once

#include<WiFi.h>

class Wifi
{
  private:
    const char* ssid;
    const char* password;

  public:
    Wifi(const char* s="", const char* p="");
    ~Wifi();
    void wifi_connect();
    void wifi_check();
    void wifi_reconnect();
};