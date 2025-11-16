# Projects App

## Overview
Projects App is a web application designed to manage projects and user authentication. It provides a simple interface for users to create, update, and delete projects while ensuring secure access through authentication.

## Features
- User authentication (login and registration)
- Project management (create, update, delete projects)
- Middleware for route protection
- Database seeding for initial data setup

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd projects-app
   ```
3. Install dependencies:
   ```
   composer install
   ```
4. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```
   cp .env.example .env
   ```
5. Generate the application key:
   ```
   php artisan key:generate
   ```
6. Run the migrations to set up the database:
   ```
   php artisan migrate
   ```
7. Seed the database with initial data:
   ```
   php artisan db:seed
   ```

## Usage
- Access the application through your web browser at `http://localhost:8000`.
- Use the following credentials to log in as an admin:
  - Email: ibnuafdel@gmail.com
  - Password: [your-password]

## Project Structure
```
projects-app
├── app
│   ├── Http
│   │   ├── Controllers
│   │   ├── Middleware
│   └── Models
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── routes
├── composer.json
├── .env.example
└── README.md
```

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is open-source and available under the [MIT License](LICENSE).