#include"serveresp32.h"

#include <ArduinoJson.h>

ServerESP32::ServerESP32(const char* sa, const char* dra, const char* ma, const char* aa, const String akv, Sensors* s, Wifi* w):
  server_address(sa),
  db_response_address(dra),
  manual_address(ma),
  automatic_address(aa),
  api_key_value(akv),
  http_client(),
  sensors(s),
  wifi(w),
  soil_moisture_base(0),
  temperature_base(0)
{

}

ServerESP32::~ServerESP32()
{
  server_address=NULL;
  db_response_address=NULL;
  manual_address=NULL;
  automatic_address=NULL;
  api_key_value="";
  sensors=NULL;
}

const int ServerESP32::http_response()
{
  http_client.begin(db_response_address);
  int http_code = http_client.GET();
  int status=0;

  //Checks whether HTTP connection has returned 200 code (OK)
  if (http_code==HTTP_CODE_OK)
  {
    String payload = http_client.getString();

    //Automatic memory allocation and deallocation
    DynamicJsonDocument doc(64);
    deserializeJson(doc, payload);

    //Read JSON values
    status = doc["manual_data_connection_type"];
    Serial.print("Status: ");
    Serial.println(status);
  } 

  else 
  {
    Serial.println("HTTP requisition failed (http_response function)");
    ESP.restart();
  }

  http_client.end(); 

  return(status);
}

void ServerESP32::manual_mode()
{
  http_client.begin(manual_address);

  const int http_code = http_client.GET();

  //Checks whether HTTP connection has returned 200 code (OK)
  if (http_code == HTTP_CODE_OK)
  {
    String payload = http_client.getString();

    //Automatic memory allocation and deallocation
    DynamicJsonDocument doc(256);
    deserializeJson(doc, payload);

    soil_moisture_base=doc["soil_moisture"];
    temperature_base=doc["air_temperature"];
    Serial.print("Base temperature: ");
    Serial.println(temperature_base);
    Serial.print("Base soil moisture: ");
    Serial.println(soil_moisture_base);
  }

  else 
  {
    Serial.println("HTTP requisition failed (manual_mode function)");
    ESP.restart();
  }

  http_client.end(); 
}

void ServerESP32::automatic_mode()
{
  http_client.begin(automatic_address);
  const int http_code = http_client.GET();

  //Checks whether HTTP connection has returned 200 code (OK)
  if (http_code == HTTP_CODE_OK)
  {
    String payload = http_client.getString();

    //Automatic memory allocation and deallocation
    DynamicJsonDocument doc(256);
    deserializeJson(doc, payload);

    temperature_base=doc["air_temperature"];
    soil_moisture_base=doc["soil_moisture"]; 
    Serial.print("Base temperature: ");
    Serial.println(temperature_base);
    Serial.print("Base soil moisture: ");
    Serial.println(soil_moisture_base);
  } 

  else 
  {
    Serial.println("HTTP requisition failed (manual_mode function)");
    ESP.restart();
  }

  http_client.end();
}

void ServerESP32::server_injection()
{
  float soil_moisture=sensors->moisture_sensor_read;
  float air_humidity=sensors->air_humidity_read;
  float air_temperature=sensors->air_temperature_read;
  float is_dark=sensors->ldr_read;

  if(WiFi.status()== WL_CONNECTED)
  {
    WiFiClientSecure *client = new WiFiClientSecure;
    client->setInsecure(); 

    // Your Domain name with URL path or IP address with path
    http_client.begin(*client, server_address);

    http_client.addHeader("Content-Type", "application/x-www-form-urlencoded");


    String http_request_data = "api_key=" + api_key_value + "&soil_moisture=" + String(soil_moisture)
      + "&air_humidity=" + String(air_humidity) + "&air_temperature=" + String(air_temperature) + 
      + "&is_dark=" + String(is_dark) + "";


    Serial.print("httpRequestData: ");
    Serial.println(http_request_data);

    int http_response_code = http_client.POST(http_request_data);

    if (http_response_code>0) 
    {
      Serial.print("HTTP Response code: ");
      Serial.println(http_response_code);
    }

    else 
    {
      Serial.print("Error code: ");
      Serial.println(http_response_code);
    }

    http_client.end();
  }

  else
  {
    Serial.println("WiFi Disconnected");
    ESP.restart();
  }
}

const float ServerESP32::get_soil_moisture_base()
{
  return(soil_moisture_base);
}

const float ServerESP32::get_temperature_base()
{
  return(temperature_base);
}
