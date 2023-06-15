#include"sensors.h"
#include"wifi.h"
#include"serveresp32.h"
#include"PID_v1.h"

#define MOISTURE_SENSOR_PIN 33
#define LDR_PIN 19
#define DHT_22_PIN 5
#define DHT_TYPE DHT22

#define MOTORS_PIN 13
#define WATER_PUMP_PIN 12
#define INCANDESCENT_LAMP_PIN 26
#define PLANT_LED_PIN 14

const char* ssid="";
const char* password="";

const char* server_address="https://ip/data_insert.php";
const char* db_response_address="https://ip/db_response.php";
const char* manual_address="https://ip/manual.php";
const char* automatic_address="https://ip/automatic.php";
String api_key_value="";

Sensors sensors(MOISTURE_SENSOR_PIN, LDR_PIN, DHT_22_PIN);
Wifi wifi(ssid, password);
ServerESP32 serveresp32(server_address, db_response_address, manual_address, automatic_address, api_key_value, &sensors);

double pid_motor_input, pid_motor_set_point, pid_motor_output=0;
double pid_water_pump_input, pid_water_pump_set_point, pid_water_pump_output=0;
PID pid_motor(&pid_motor_input, &pid_motor_output, &pid_motor_set_point, 50, 0, 0, REVERSE);
PID pid_water_pump(&pid_water_pump_input, &pid_water_pump_output, &pid_water_pump_set_point, 50, 0, 0, DIRECT);

void setup() 
{
  Serial.begin(115200);
  wifi.wifi_connect();
  pid_motor.SetMode(AUTOMATIC);
  pid_water_pump.SetMode(AUTOMATIC);
  pinMode(MOISTURE_SENSOR_PIN, INPUT);
  pinMode(LDR_PIN, INPUT);
  pinMode(DHT_22_PIN, INPUT);
  pinMode(MOTORS_PIN, OUTPUT);
  pinMode(WATER_PUMP_PIN, OUTPUT);
  pinMode(INCANDESCENT_LAMP_PIN, OUTPUT);
  pinMode(PLANT_LED_PIN, OUTPUT);
}

void loop() 
{
  wifi.wifi_check();

  sensors.sensors_read();

  delay(2000);


  if(serveresp32.http_response()==2)
  {
    serveresp32.manual_mode();
  }

  else
  {
    serveresp32.automatic_mode();
  }

  pid_motor_input=sensors.air_temperature_read;
  pid_motor_set_point=serveresp32.get_temperature_base();
  pid_water_pump_set_point=100-100*serveresp32.get_soil_moisture_base()/4095;
  pid_water_pump_input=100-100*sensors.moisture_sensor_read/4095;

  Serial.print("pid_motor_input");
  Serial.println(pid_motor_input);
  Serial.print("pid_motor_set_point");
  Serial.println(pid_motor_set_point);
  Serial.print("pid_water_pump_input");
  Serial.println(pid_water_pump_input);
  Serial.print("pid_water_pump_set_point");
  Serial.println(pid_water_pump_set_point);
  

  pid_motor.Compute();
  pid_water_pump.Compute();

  analogWrite(MOTORS_PIN, pid_motor_output);
  analogWrite(WATER_PUMP_PIN, pid_water_pump_output);

  if(digitalRead(LDR_PIN)==0) 
    digitalWrite(PLANT_LED_PIN, 0);
  
  else
    digitalWrite(PLANT_LED_PIN, 1);

  if(sensors.air_temperature_read<serveresp32.get_temperature_base())
    digitalWrite(INCANDESCENT_LAMP_PIN, 1);
  
  else
    digitalWrite(INCANDESCENT_LAMP_PIN, 0);

  delay(2000);

  serveresp32.server_injection();

  delay(5000);
}
