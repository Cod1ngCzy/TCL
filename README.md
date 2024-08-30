![image](https://github.com/user-attachments/assets/13d0477f-8cf9-44a4-a1a1-0e6af067abfe)# TCL Company Website

## Overview

This website is a project commision from TCL, it is a company website that provides a platform for applicants to log in and apply for jobs, while allowing administrators to manage applicant datarators.
I made this website while an Intern at TCL and it's one of their prerequisite before finishing intership.

## Features

- **Applicant Landing Page and Application**: Applicants are directly routed to tcl.php (Landing Page) to apply for job positions.
- **Admin Dashboard**: Admins can log in to view and manage applicant details, such as viewing applicant profiles, accepting/rejecting applications, and more.
- **Responsive Design**: The website is fully responsive and works on various devices and screen sizes.
- **Secure Authentication**: Passwords are hashed for security, and sessions are managed to ensure safe access. - This are done using PHP
- **Database Management**: All applicant and admin data is stored securely in a database. - SQL

## Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP 
- **Database**: MySQL/MariaDB (or SQLite/PostgreSQL) - but for this website this is entirely executed using PHP SQL.
- **Libraries/Frameworks**: The state of the website is purely JS and CSS but you can include Bootstrap, jQuery and other front end libraries.

## Installation

To run the TCL project locally, follow these steps:

1. **Clone the repository**:
    ```bash
    git clone https://github.com/yourusername/tcl-website.git
    cd tcl-website
    ```

2. **Set up the environment**:

   - Ensure you have a web server like Apache or Nginx installed. (I have used XAMPP for this demonstration)
   - Install XAMPP `https://www.apachefriends.org/`
   - After Installation start the Apache and MYSQL tab from the control panel. | Apache is for setting up the local host while MySQL is entirely for database |
   - If the modules appeared green on the control panel, it means the server is running.

3. **Set up the database**:
   - Database is hardcoded and automatically creates when you run the website on Xampp

4. **Run the server**:
   - Start your local web server and navigate to `http://localhost/tcl.php` to see the website.

## Usage

- **Applicant Flow**:
  1. Apply for job positions available on the website.
  2. Track the application status in the user dashboard.

- **Admin Flow**:
  1. Log in using the admin credentials.
  2. Access the admin dashboard to manage applicants.
  3. View, approve, or reject applications.
  4. Manage job postings and other administrative tasks.

