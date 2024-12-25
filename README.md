# Task Management System


## Overview

This project is a Task Management System built using Laravel 10. It allows users to manage tasks with features such as task creation, viewing, updating, and deletion. Additionally, it includes API endpoints for seamless integration with other applications, using Laravel Sanctum for API authentication.

---

## Project Documentation:

Project Live Demo Link From My C-panel: https://bdcodersit.com/cloudcore-test/

## Credential
    User Authentication
    -> email: demouser@gmail.com
	-> password: demouser

## Project Github Link:
   https://github.com/Rajiur-Rahman-Raj/cloudcore_test

## Project Google Drive Link:
https://drive.google.com/drive/folders/1wDExc8yrFZ9VQraT0vJsmujr8erb207L?usp=sharing

- Project's sql and api's json files are provided with the project zip file


## Features & Approach

1. **User Authentication**:
    - User registration, login, and logout implemented using the Laravel UI package.


2. **Task CRUD Operations**:
    - Create, Read, Update, and Delete tasks.
    - Tasks have attributes such as `title`, `description`, `due_date`, and `status` (Pending, In Progress, Completed).


3. **Request Validation**:
    - Used Form Request classes (e.g., `TaskRequest`) to validate input data for both web and API routes.


4. **Task Filtering and Sorting**:
    - Filter tasks by `status` (Pending, In Progress, Completed).
    - Sort tasks by `due_date`.


5. **Global Task Status Method**:
    - Created a reusable method (`getStatusBadge`) in the `Task` model to generate HTML status badges dynamically.
    - This ensures consistent status rendering across views.
   

6. **API Development**:
    - API endpoints for task operations secured with Laravel Sanctum.
    - Consistent JSON responses for API requests using a custom `ApiResponse` trait.


7. **Code Reusability**:
    - Used traits (`ApiResponse`) to standardize success and error responses.
    - Centralized validation and response handling to reduce duplication.


5. **Server Side Pagination**:
    - Pagination is implemented for task listing to handle large datasets efficiently.



## Installation

## Project run guideline From Local Server
===========================================

1. **Clone the repository**::
   ```bash
   git clone <repository-url>
   cd cloudcore_test
   
   Or the entire project google drive download link share to you as a zip file.
   Along with the zip file, the sql and postman api json file is also provided inside the folder.
   
2. **Need to have a local server on your PC**:
    - example: xammp 


3. **Run the project on your PC**:
    - you need to place My Project folder inside your xampp htdocs folder. otherwize it's not working
      (php artisan serve Command will not work to run this project)


4. **Set up the environment**:
    - Copy .env.example to .env and configure database and other settings.
    - Create a database and import my given sql file into that database. or run this command `php artisan migrate`


5. **Run Project**:
    - run the project with localhost / project name in your browser URL.

    
---
