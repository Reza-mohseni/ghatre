#include "DHT.h"
#define DHTPIN 2
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);
 
#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// WiFi credentials
const char* ssid = "YOUR_SSID";  // نام WiFi
const char* password = "YOUR_PASSWORD";  // رمز WiFi
const char* rainApiUrl = "http://yourserver.com/app/controllers/Arduino/rain.php";  // URL برای ارسال وضعیت باران
const char* watering = "http://yourserver.com/app/controllers/Arduino/watering.php";  // URL برای ارسال رطوبت خاک
const char* weather_conditions = "http://yourserver.com/app/controllers/Arduino/weather_conditions.php" ; // URL برای ارسال وضعیت هوا

// متغیرها
// Sensor رطوبت خاک pins
#define sensorPower_rtobatkhak1 5
#define sensorPin_rtobatkhak1 A0
#define sensorPower_rtobatkhak2 4
#define sensorPin_rtobatkhak2 A1
#define sensorPower_rtobatkhak3 3
#define sensorPin_rtobatkhak3 A2

// رله
#define relay1 12
#define relay2 11
#define relay3 10
// Sensor pins باران
#define sensorPower_baran 7
#define sensorPin_baran 8

// وضعیت پمپ‌ها
int status_waterpomp1 = 0;
int status_waterpomp2 = 0;
int status_waterpomp3 = 0;

int rtobatkhak1, rtobatkhak2, rtobatkhak3, status_baran;

LiquidCrystal_I2C lcd(0x27, 16, 2);  // set the LCD address to 0x3F for a 16 chars and 2 line display

// Define a custom degree character
byte Degree[] = {
  B00000,
  B00000,
  B00111,
  B00000,
  B00000,
  B00000,
  B00000,
  B00000
};

void connectToWiFi() {
  Serial.print("Connecting to WiFi");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println();
  Serial.println("Connected to WiFi");
}

void sendDataToServer(const char* apiUrl, String postData) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(apiUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.print("Error on sending POST: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }
}

void setup() {
  pinMode(relay1, OUTPUT);
  pinMode(relay2, OUTPUT); 
  pinMode(relay3, OUTPUT);
  digitalWrite(relay1, HIGH);
  digitalWrite(relay2, HIGH);
  digitalWrite(relay3, HIGH);

  // رطوبت خاک 
  pinMode(sensorPower_rtobatkhak1, OUTPUT);
  pinMode(sensorPower_rtobatkhak2, OUTPUT);
  pinMode(sensorPower_rtobatkhak3, OUTPUT);
  // Initially keep the sensor OFF
  digitalWrite(sensorPower_rtobatkhak1, LOW);
  digitalWrite(sensorPower_rtobatkhak2, LOW);
  digitalWrite(sensorPower_rtobatkhak3, LOW);
  
  // مانیتور
  lcd.init();
  lcd.backlight();
  lcd.createChar(0, Degree);

  pinMode(sensorPower_baran, OUTPUT);
  // Initially keep the sensor OFF
  digitalWrite(sensorPower_baran, LOW);

  dht.begin(); // initialize the sensor
  Serial.begin(9600);

  connectToWiFi();
}
 
void loop() {
  rtobatkhak1 = readSensor_rtobatkhak1();
  delay(3000);
  rtobatkhak2 = readSensor_rtobatkhak2();
  delay(3000);
  rtobatkhak3 = readSensor_rtobatkhak3();
  delay(3000);
  status_relay();
  delay(9000);
  returnstatus_hava();
  delay(2000);
  status_baran = readSensor_baran();
  if (status_baran != 1) {
    status_waterpomp1 = 0;
    status_waterpomp2 = 0;
    status_waterpomp3 = 0;
  }
  delay(2000);

  // Print data to Serial
  Serial.print("رطوبت خاک ردیف 1: ");
  Serial.println(rtobatkhak1);
  Serial.print("رطوبت خاک ردیف 2: ");
  Serial.println(rtobatkhak2);
  Serial.print("رطوبت خاک ردیف 3: ");
  Serial.println(rtobatkhak3);

  // Get temperature and humidity
  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();

  // Check if reads failed
  if (isnan(humidity) || isnan(temperature)) {
    Serial.println("Failed to read from DHT sensor!");
  } else {
    // Send soil moisture data to server
    // Send rain status to server
    String rainData = "status=" + String(status_baran);
    sendDataToServer(rainApiUrl, rainData);
  }

  delay(5000);
}

// This function returns the sensor output for باران
int readSensor_baran() {
  digitalWrite(sensorPower_baran, HIGH);    // Turn the sensor ON
  delay(10);                          // Allow power to settle
  int status_barar = digitalRead(sensorPin_baran);   // Read the sensor output
  digitalWrite(sensorPower_baran, LOW);     // Turn the sensor OFF
  return status_barar;                         // Return the value
}

// This function returns the analog soil moisture measurement
int readSensor_rtobatkhak1() {
  digitalWrite(sensorPower_rtobatkhak1, HIGH);    // Turn the sensor ON
  delay(10);                          // Allow power to settle
  int val_rtobatkhak1 = analogRead(sensorPin_rtobatkhak1);    // Read the analog value form sensor
  digitalWrite(sensorPower_rtobatkhak1, LOW);     // Turn the sensor OFF
  return val_rtobatkhak1;                         // Return analog moisture value
}

int readSensor_rtobatkhak2() {
  digitalWrite(sensorPower_rtobatkhak2, HIGH);    // Turn the sensor ON
  delay(10);                          // Allow power to settle
  int val_rtobatkhak2 = analogRead(sensorPin_rtobatkhak2);    // Read the analog value form sensor
  digitalWrite(sensorPower_rtobatkhak2, LOW);     // Turn the sensor OFF
  return val_rtobatkhak2;                         // Return analog moisture value
}

int readSensor_rtobatkhak3() {
  digitalWrite(sensorPower_rtobatkhak3, HIGH);    // Turn the sensor ON
  delay(10);                          // Allow power to settle
  int val_rtobatkhak3 = analogRead(sensorPin_rtobatkhak3);    // Read the analog value form sensor
  digitalWrite(sensorPower_rtobatkhak3, LOW);     // Turn the sensor OFF
  return val_rtobatkhak3;                         // Return analog moisture value
}

void status_waterpomp() {
  if (rtobatkhak1 < 275) {
    status_waterpomp1 = 0;
        String soilMoistureData = "watering_row=" + String(1) +
                              "&status=" + String(status_waterpomp1) +
                              "&degree_humidity=" + String(rtobatkhak1);
    sendDataToServer(watering, soilMoistureData);

  } else if (rtobatkhak1 > 850 && readSensor_baran() != 0) {
    status_waterpomp1 = 1;
            String soilMoistureData = "watering_row=" + String(0) +
                              "&status=" + String(status_waterpomp1) +
                              "&degree_humidity=" + String(rtobatkhak1);
    sendDataToServer(watering, soilMoistureData);
  }
  if (rtobatkhak2 < 275) {
    status_waterpomp2 = 0;
            String soilMoistureData = "watering_row=" + String(2) +
                              "&status=" + String(status_waterpomp2) +
                              "&degree_humidity=" + String(rtobatkhak2);
    sendDataToServer(watering, soilMoistureData);
  } else if (rtobatkhak2 > 850 && readSensor_baran() != 0) {
    status_waterpomp2 = 1;
                String soilMoistureData = "watering_row=" + String(2) +
                              "&status=" + String(status_waterpomp2) +
                              "&degree_humidity=" + String(rtobatkhak2);
    sendDataToServer(watering, soilMoistureData);
  }
  if (rtobatkhak3 < 275) {
    status_waterpomp3 = 0;
                String soilMoistureData = "watering_row=" + String(3) +
                              "&status=" + String(status_waterpomp3) +
                              "&degree_humidity=" + String(rtobatkhak3);
    sendDataToServer(watering, soilMoistureData);
  } else if (rtobatkhak3 > 850 && readSensor_baran() != 0) {
    status_waterpomp3 = 1;
                    String soilMoistureData = "watering_row=" + String(3) +
                              "&status=" + String(status_waterpomp3) +
                              "&degree_humidity=" + String(rtobatkhak3);
    sendDataToServer(watering, soilMoistureData);
  }
}

void status_relay() {
  if (status_waterpomp1 == 1) {
    digitalWrite(relay1, LOW);
  } else {
    digitalWrite(relay1, HIGH);
  }
  if (status_waterpomp2 == 1) {
    digitalWrite(relay2, LOW);
  } else {
    digitalWrite(relay2, HIGH);
  }
  if (status_waterpomp3 == 1) {
    digitalWrite(relay3, LOW);
  } else {
    digitalWrite(relay3, HIGH);
  }
}

void returnstatus_hava() {
  // wait a few seconds between measurements.
  delay(2000);

  // read humidity
  float humi = dht.readHumidity();
  // read temperature as Celsius
  float tempC = dht.readTemperature();
  // read temperature as Fahrenheit
  float tempF = dht.readTemperature(true);

  // check if any reads failed
  if (isnan(humi) || isnan(tempC) || isnan(tempF)) {
    Serial.println("Failed to read from DHT sensor!");
  } else {
    int humir = (int)round(humi);
    lcd.setCursor(0, 0);
    lcd.print("Humidity: ");
    lcd.setCursor(9, 0);
    lcd.print(humir);
    lcd.setCursor(12, 0);
    lcd.print("%");
    Serial.print("Humidity: ");
    Serial.print(humi);
    Serial.print("%");

    Serial.print("  |  ");
    lcd.setCursor(0, 1);
    lcd.print("Temperature: ");
    lcd.setCursor(12, 1);
    lcd.print(tempC);
    Serial.print("Temperature: ");
    Serial.print(tempC);
    Serial.println("°C");
                    String soilMoistureData = "temperatureC=" + String(tempC) +
                              "&temperatureF=" + String(tempF) +
                              "&humidity=" + String(humi);
    sendDataToServer(weather_conditions, soilMoistureData);
  }
}
