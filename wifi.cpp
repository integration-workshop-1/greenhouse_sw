#include"wifi.h"

Wifi::Wifi(const char* s, const char* p):
  ssid(s),
  password(p)
{

}

Wifi::~Wifi()
{
  ssid=NULL;
  password=NULL;
}

void Wifi::wifi_connect()
{
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  int time_out=0;

  while(WiFi.status()!=WL_CONNECTED)
  { 
    delay(500);
    Serial.print(".");
    time_out++;
    if(time_out==30)
      ESP.restart();
  }

  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void Wifi::wifi_check()
{
  if(WiFi.status()!=WL_CONNECTED)
  {
    wifi_reconnect();
    Serial.println("Reconnecting...");
    delay(500);
  }
}

void Wifi::wifi_reconnect()
{
  WiFi.disconnect();
  WiFi.reconnect();
}
