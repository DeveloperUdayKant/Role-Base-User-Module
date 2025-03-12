# Role Base User Module

## Overview
The Role-Based User Module is designed to manage user authentication and authorization based on predefined roles. This module enables secure access control by assigning specific permissions to different user roles.

## Features
- User authentication (login, logout, registration)
- Role-based access control (RBAC)
- User role assignment
- Permission management
- Middleware for route protection
- Admin panel for user and role management

## Installation

### Prerequisites
Ensure you have the following installed:
- PHP 
- Database (MySQL)

### Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/DeveloperUdayKant/Role-Base-User-Module.git
   cd role-based-user-module
   ```

## Usage
### Assigning Roles to Users
After seeding, roles like `admin`, `editor`, and `user` will be available. You can assign a role to a user using:
```php
is_active = 1
```


## API Endpoints
| Method | Endpoint       | Description             |
|--------|----------------|-------------------------|
| POST   | /login         | Authenticate user       |
| POST   | /signup        | Register a new user     |
| GET    | /users         | Get all users (admin)   |
| PUT    | /users/{id}    | Update user role        |
| DELETE | /users/{id}    | Delete a user (admin)   |

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
This project is licensed under the MIT License.

