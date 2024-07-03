#include "DHT.h"
#define DHTPIN 2
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);
 
#include <LiquidCrystal_I2C.h>
//متغییر ها
// Sensor رطوبت خاک pins
#define sensorPower_rtobatkhak1 5
#define sensorPin_rtobatkhak1 A0
#define sensorPower_rtobatkhak2 4
#define sensorPin_rtobatkhak2 A1
#define sensorPower_rtobatkhak3 3
#define sensorPin_rtobatkhak3 A2


/////////////////////////////////////////

///رله
#define relay1 12
#define relay2 11
#define relay3 10
// #define relay4 9
// Sensor pins baran
#define sensorPower_baran 7
#define sensorPin_baran 8
//////////////////////
///وضعیت پمپ ها

int status_waterpomp1= 0;
int status_waterpomp2= 0;
int status_waterpomp3= 0;


////////////////////////////


int rtobatkhak1,rtobatkhak2,rtobatkhak3,status_baran;
 
LiquidCrystal_I2C lcd(0x27,16,2);  // set the LCD address to 0x3F for a 16 chars and 2 line display
 
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


void setup() {
    pinMode(relay1, OUTPUT);
    pinMode(relay2, OUTPUT); 
    pinMode(relay3, OUTPUT);
    digitalWrite(relay1, HIGH);
    digitalWrite(relay2, HIGH);
    digitalWrite(relay3, HIGH);
  // Serial.println("Initializing... Please wait.");

//رطوبت خاک 
    pinMode(sensorPower_rtobatkhak1, OUTPUT);
    pinMode(sensorPower_rtobatkhak2, OUTPUT);
    pinMode(sensorPower_rtobatkhak3, OUTPUT);
    // Initially keep the sensor OFF
    digitalWrite(sensorPower_rtobatkhak1, LOW);
    digitalWrite(sensorPower_rtobatkhak2, LOW);
    digitalWrite(sensorPower_rtobatkhak3, LOW);
    
  //monitor

      // Start the LCD and turn on the backlight
      lcd.init();
      lcd.backlight();
    
      // Create a custom character
      lcd.createChar(0, Degree);
  ////////////////////////////

    pinMode(sensorPower_baran, OUTPUT);
    
    // Initially keep the sensor OFF
    digitalWrite(sensorPower_baran, LOW);

    dht.begin(); // initialize the sensor

    Serial.begin(9600);
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
  status_baran= readSensor_baran();
  if (status_baran!=1){
    status_waterpomp1= 0;
    status_waterpomp2= 0;
    status_waterpomp3= 0;
  }
  delay(2000);
  // delay(5000);
    //get the reading from the function below aint status_baran = readSensor_baran();
    Serial.print("Digital Output: ");
    Serial.println(status_baran);
 

 

    // Determine status of rain
    if (status_baran) {
        Serial.println("Status: Clear");
    } else {
        Serial.println("Status: It's raining");
    }

Serial.println();

delay(2000);
status_waterpomp();

  
     //get the reading from the function below and print it
    Serial.print("رطوبت خاک ردیف 1: ");
    Serial.println(rtobatkhak1);
    Serial.print("رطوبت خاک ردیف 2: ");
    Serial.println(rtobatkhak2);
    Serial.print("رطوبت خاک ردیف 3: ");
    Serial.println(rtobatkhak3);
    // delay(5000);
    


    

delay(5000);
}
 

 //باران 
//  This function returns the sensor output
int readSensor_baran() {
    digitalWrite(sensorPower_baran, HIGH);    // Turn the sensor ON
    delay(10);                          // Allow power to settle
    int status_barar = digitalRead(sensorPin_baran);   // Read the sensor output
    digitalWrite(sensorPower_baran, LOW);     // Turn the sensor OFF
    return status_barar;                         // Return the value
}


//دریافت رطوبت خاک
//  This function returns the analog soil moisture measurement
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
void status_waterpomp(){
    if (rtobatkhak1<275){
       status_waterpomp1= 0;
    }else if(rtobatkhak1>850 && readSensor_baran() !=0 )
    {
       status_waterpomp1= 1;
    }
    if (rtobatkhak2<275 ){
       status_waterpomp2= 0;
    }
    else if(rtobatkhak2>850 && readSensor_baran() !=0)
    {
     status_waterpomp2= 1;
    }
    if (rtobatkhak3<275){
      status_waterpomp3= 0;
    }else if(rtobatkhak3>850 && readSensor_baran() !=0)
    {
      status_waterpomp3= 1;
    }
}

void status_relay(){
    if (status_waterpomp1==1){
      digitalWrite(relay1 , LOW);
    }else{
       digitalWrite(relay1 , HIGH);
    }
    if (status_waterpomp2==1){
      digitalWrite(relay2 , LOW);
    }else{
       digitalWrite(relay2 , HIGH);;
    }
    if (status_waterpomp3==1){
      digitalWrite(relay3 , LOW);
    }else{
       digitalWrite(relay3 , HIGH);
    }
}

void returnstatus_hava(){
 // wait a few seconds between measurements.
  delay(2000);

  // read humidity
  float humi  = dht.readHumidity();
  // read temperature as Celsius
  float tempC = dht.readTemperature();
  // read temperature as Fahrenheit
  float tempF = dht.readTemperature(true);

  // check if any reads failed
  if (isnan(humi) || isnan(tempC) || isnan(tempF)) {
    Serial.println("Failed to read from DHT sensor!");
  } else {
   int  humir= (int)round(humi);
    lcd.setCursor(0, 0);
    lcd.print("Humidity: ");
    lcd.setCursor(9, 0);
    lcd.print(humir);
    lcd.setCursor(12, 0);
    lcd.print("%");
    Serial.print("Humidity: ");
    Serial.print(humi);
    Serial.print("%");

    Serial.print("  |  "); -
    lcd.setCursor(0, 1);
    lcd.print("Temperature: ");
    lcd.setCursor(12, 1);
    lcd.print(tempC);
    Serial.print("Temperature: ");
    Serial.print(tempC);
    Serial.println("°C");
  }
}
