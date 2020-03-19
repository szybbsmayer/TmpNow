#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>
#include <ESP8266WiFi.h>  
#include <InfluxDbClient.h>

// InfluxDB server url, e.g. http://192.168.1.48:8086 (don't use localhost, always server name or ip address)
#define INFLUXDB_URL "http://192.168.137.43:8086"
// InfluxDB database name 
#define INFLUXDB_DB_NAME "TmpNow"

    
// Single InfluxDB instance
InfluxDBClient client(INFLUXDB_URL, INFLUXDB_DB_NAME);
// Define data point with measurement name 'device_status`
Point data("data");

Adafruit_BME280 bme;

float temperature, humidity, pressure;
bool wifiConnected = false;

const char* ssid = "tmpnow";  // Enter SSID here
const char* password = "12345678";  //Enter Password here

void setup() {
  Serial.begin(115200);
  delay(100);
  
  bme.begin(0x76);   

  WiFi.begin(ssid, password);             // Connect to the network
  Serial.print("Connecting to ");
  Serial.print(ssid); Serial.println(" ...");

  int i = 0;
  while (WiFi.status() != WL_CONNECTED) { // Wait for the Wi-Fi to connect
    delay(1000);
    Serial.print(++i); Serial.print(' ');
    if (i >= 20){
      break;
    }
  }
  if (WiFi.status() == WL_CONNECTED){
    Serial.println('\n');
    Serial.println("Connection established!");  
    Serial.print("IP address:\t");
    Serial.println(WiFi.localIP());         // Send the IP address of the ESP8266 to the computer
    wifiConnected=true;
  }
  else{
    Serial.println("Not able to connect to Wifi!");
  }

  // Check server connection
  if (client.validateConnection()) {
    Serial.print("Connected to InfluxDB: ");
    Serial.println(client.getServerUrl());
  } else {
    Serial.print("InfluxDB connection failed: ");
    Serial.println(client.getLastErrorMessage());
  }
  
  //Set Tag
  data.addTag("device", "ESP8266_1");  
}

void loop() {
  data.clearFields();
  getSensorData();
  
  // Add data
  data.addField("temperature", temperature);
  data.addField("humidity", humidity);
  data.addField("pressure", pressure);

  Serial.println(data.toLineProtocol());
  
  if(wifiConnected){
    if (!client.writePoint(data)) {
      Serial.print("InfluxDB write failed: ");
      Serial.println(client.getLastErrorMessage());
    }
  }
  else{
    Serial.println("no wifi");
  }
  delay(60000);
}

void getSensorData(){
  temperature = bme.readTemperature();
  humidity = bme.readHumidity();
  pressure = bme.readPressure()  / 100.0F;
}
