# Library Management System

## Overview
A comprehensive Library Management System built to automate and streamline library operations. This system helps librarians and administrators manage books, members, and lending processes efficiently.

## Features
- Book Management
  - Add, update, and delete book records
  - Track book availability status
  - Manage multiple copies of the same book
  - Search books by title, author, or ISBN

- Member Management
  - Register new members
  - Update member information
  - Track membership status
  - Manage member borrowing history

- Lending Operations
  - Issue books to members
  - Process book returns
  - Calculate and manage fines for late returns
  - Generate lending reports

- Admin Dashboard
  - Overview of library statistics
  - Monitor overdue books
  - Track popular books
  - Generate various reports

## Technology Stack
- Frontend: HTML, CSS, JavaScript
- Backend: Python
- Database: SQLite/MySQL
- Framework: Flask/Django

## Installation
1. Clone the repository
```bash
git clone https://github.com/somyadipghosh/library_management.git
```
2. Install dependencies
```bash
pip install -r requirements.txt
```
3. Navigate to the Project Directory:
```bash
cd library_management
```
4. Set Up the Database:
  - Create a MySQL database named library_db.
  - Import the provided db.sql file to set up the necessary tables.

5. Configure Database Connection:
  - Open the db.php file.
  - Update the database connection parameters (host, username, password, database) to match your MySQL configuration.

6. Start the Application:
  - Deploy the project files to your web server's root directory.
  - Access the application through your web browser.

## Usage
- Admin Login:
  - Navigate to the login page (login.php).
  - Enter your admin credentials to access the dashboard.

- Dashboard:
  - View summaries of books, members, and recent activities.

- Manage Books:
  - Use the "Add Book" feature to include new books.
  - Edit or delete existing books as needed.

- Manage Members:
  - Register new members through the "Add Member" form.
  - Update member information or remove members from the system.

- Issue/Return Books:
  - Issue books to members and set return due dates.
  - Process book returns and update the system accordingly.
