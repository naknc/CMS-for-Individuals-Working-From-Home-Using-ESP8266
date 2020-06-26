#include <ESP8266WiFi.h>
#include <FirebaseArduino.h>

#define FIREBASE_HOST "*************"
#define FIREBASE_AUTH "*********"
#define WIFI_SSID "********"
#define WIFI_PASSWORD "*****"

int LedPin = 13;
int LedPin1 = 14;

void setup() {
  Serial.begin(9600);
  pinMode(LedPin, OUTPUT);
  pinMode(LedPin1, OUTPUT);
 
 
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
 
  Serial.println();
  Serial.println("connected: ");
  Serial.println(WiFi.localIP());

  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
}

void loop() {
   String sLampStatus = Firebase.getString("LampStatus");
   Serial.println(sLampStatus);
   delay(500);

  if(sLampStatus=="admin")
  {
    digitalWrite(LedPin, LOW);
    digitalWrite(LedPin1, HIGH);
    
  }
  else if (sLampStatus=="user")
  {
    digitalWrite(LedPin1, LOW);
    digitalWrite(LedPin, HIGH);
  }
  else if (sLampStatus=="empty")
  {
    digitalWrite(LedPin1, HIGH);
    digitalWrite(LedPin, HIGH);
  }
}
