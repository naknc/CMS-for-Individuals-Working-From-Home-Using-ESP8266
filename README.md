# NodeMcu Lua V3 CH340G ESP8266 WLAN Module - Content Management System

## Overview

This repository contains the source code and documentation for the "Content Management System for Individuals Working From Home Using the ESP8266 WiFi Module." The project, created by Nihan Akıncı, is designed to help individuals working from home manage their tasks efficiently. It is part of a larger project and uses the NodeMcu Lua V3 CH340G ESP8266 WLAN module.

## Project Description

In this project, we have developed a content management service specifically for individuals working from home. The system allows users to plan and manage their tasks effectively. Key features of the system include:

- User Data Management: Users can add, view, update, and delete various data related to their work tasks.
- Firebase Integration: The system interacts with Firebase to create responses. When an admin logs in, an "admin" response is sent, turning on a green light. When a regular user logs in, a "user" response is sent, turning on a red light. Logging out sends an "empty" response, turning off both lights.
- Access Control: The system is managed by an admin, and unauthorized users cannot access sections they are not allowed to. Access to buttons is also restricted based on user roles.
- Technologies Used: The project is built using PHP, C#, and JavaScript languages, with Apache and IIS as web services, and MySQL as the database management system. Various development tools, including Visual Studio, Visual Studio Code, Arduino IDE, XAMPP, phpMyAdmin, and IIS Manager, were employed in the project.

The project aims to provide a robust content management system for individuals, enhancing their productivity and task management while working from home.

## Project Structure

The project is organized into the following components:

- Content Management Service: This is the core functionality of the system, divided into fourteen parts. Each part is controlled by a controller in the framework, tested in the core folder on VS_Controller, and shown based on user permissions.
- Visual Components: Visual parts of the project are located in the view folders, organized into separate folders for listing, adding, and updating. Additional folders may be present for multimedia content.
- Models: Models are responsible for communicating with the database. Initially, functions were scattered throughout the project, but they were consolidated in a VS_Model in the core folder to improve code organization and safety.
- Board for LEDs and NodeMCU Code

The system includes LED lights to indicate the user's role. Green light represents an admin user, and red light represents a regular user. Both lights turn off when a user logs out.

- Arduino IDE: The code for the NodeMcu Lua V3 CH340G ESP8266 WLAN module was written using Arduino IDE 1.8.12. Libraries used include ArduinoJson 5.13.1 and FirebaseJson 2.3.4.
- Arduino IDE Setup: The setup process includes defining necessary information, assigning pins, setting pin modes, initializing Wi-Fi connection, and establishing a connection to Firebase. The code continuously receives data and controls the LEDs based on specific responses.

## Database Integration and Response Sending

For data management and response creation, Firebase is integrated into the system. The process includes:

- Firebase Account: A Firebase account is set up to create a real-time database. Read and write rules are set to true for database access.
- Port Configuration: Port 88 is used for broadcasting responses. IIS Manager is configured to route requests to port 88.
- C# Code: C# codes are used to create URL links for sending responses to Firebase. The responses are based on the system's status, Firebase database name, and secret key.

## PHP Scripting for Popup Responses

PHP scripting is used to open a new tab for sending responses to Firebase without directing the user away from the current page. This ensures a seamless user experience.

## Conclusion

The project allows the broadcasting of a working content management service on port 80 using Apache Web Server and MySQL. Unauthorized users are prevented from accessing restricted content and features.

Additionally, the system can send responses to Firebase on port 88, triggering the corresponding LED lights. This project has broad applications in making various devices smarter in different work areas. It has enabled the exploration of different technologies, the power of IoT, and the understanding of programming languages' capabilities and limitations.

The knowledge gained from this project will be valuable for future projects and in the working field.

**Author: Nihan Akıncı**

[LinkedIn Profile](https://www.linkedin.com/in/nihanakinci/)
