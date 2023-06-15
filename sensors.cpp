#include"sensors.h"

Sensors::Sensors(const int msp, const int ldrp, const int d22p):
  moisture_sensor_pin(msp),
  ldr_pin(ldrp),
  dht_22_pin(d22p),
  dht22(dht_22_pin, DHT22),
  moisture_sensor_read(0),
  air_humidity_read(0),
  air_temperature_read(0),
  ldr_read(0)
{
  dht22.begin();
}

Sensors::~Sensors()
{

}

void Sensors::sensors_read()
{
  moisture_sensor_read=analogRead(moisture_sensor_pin);
  air_humidity_read=dht22.readHumidity();
  air_temperature_read=dht22.readTemperature();
  ldr_read=digitalRead(ldr_pin);

  Serial.print("Soil moisture: ");
  Serial.println(moisture_sensor_read);

  Serial.print("Air humidity (%): ");
  Serial.println(air_humidity_read);

  Serial.print("Air temperature (°C): ");
  Serial.println(air_temperature_read);

  Serial.print("Is dark? ");
  Serial.println(ldr_read);
}