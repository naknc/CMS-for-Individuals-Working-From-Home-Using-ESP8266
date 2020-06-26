Content Management System for Individuals Working From Home Using the ESP8266 WiFi Module

***ABSTRACT***

In this project; I tried to create a content management service for individuals working from home using ESP8266 WiFi module. My service is actually a module of a bigger project. My goal is to use it in a company’s site to help people to plan their tasks in their daily work. People can add various of datas to its related part of the system. They can see and change them if they want. Also they can delete it whenever they want to.

Addition to this, when logining this service can create responses to Firebase. Response can be created again when logout. If the admin logs in “admin” response sends and green light turnes on. If user logs in “user” response sends and red light turnes on. If current person using the system logs out, “empty” response sends and both lights turnes off.

System is managed by the admin. Non-authorized users cannot see the sections that they are not allowed. Also buttons are only shown to the users that they are allowed. So for example, a person may see a section but add new button may now be shown to that person.

Keywords: PHP, MySQL, NodeMcu Lua V3 CH340G ESP8266 WLAN Module, Firebase, IoT 

***INTRODUCTION***

For this project I used; PHP, C#, Javascript languages; Apache and IIS as web services and MySQL as database management system. I used Visual Studio, Visual Studio Code, Arduino IDE, XAMPP, phpMyAdmin, IIS Manager as tools.

Firstly, I tried to create a service to see and manage various parts of a company. This service is a module of a bigger project. In this module, a person can login, add/delete/update different products, clients, services etc. If he/she forgot password, I can send an e-mail to him/her. I divided this service into fourteen parts. I explain details in the report’s in the next pages.

Secondly; after I finished my work with the content management service, I added the NodeMcu Lua V3 CH340G ESP8266 WLAN module. I wrote its code on Arduino IDE and upload it to card. The code waits for spesific strings from Firebase and turns on and turns of leds according to responses it receives.

Thirdly, I wrote C# codes to create url links to send responses to Firebase. I set my IIS’s default page’s port to 88. I send different responses using the Firebase database name and secret key to LampStatus request.

Finally, I content.php in users_v->list  and  users_v->login folders I added Javascript codes. I checked if the current user’s user role id is admin or user. If the condition matched,  I assigned related url to a variable and opened a new tab using the my response url variable.#   C M S - f o r - I n d i v i d u a l s - W o r k i n g - F r o m - H o m e - U s i n g - E S P 8 2 6 6  
 #   C M S - f o r - I n d i v i d u a l s - W o r k i n g - F r o m - H o m e - U s i n g - E S P 8 2 6 6  
 