# Reminders App

A simple and secure web application for managing personal reminders with user authentication.

[![Live Demo](https://img.shields.io/badge/Live-Demo-brightgreen)](https://reminders-app-nuw8.onrender.com)

## Features

- User authentication (register, login, logout)
- Create, read, update, and delete reminders
- Mark reminders as complete/incomplete
- Secure password hashing
- Account lockout after multiple failed login attempts
- Responsive design

## Live Demo

Check out the live demo: [Reminders App](https://reminders-app-nuw8.onrender.com)

## Technologies Used

- **Backend**: PHP
- **Database**: PostgreSQL
- **Frontend**: HTML, CSS, JavaScript
- **Authentication**: Session-based
- **Deployment**: Render

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- PostgreSQL 12 or higher
- Web server (Apache/Nginx)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/roypushpak/reminders-app.git
   cd reminders-app
   ```

2. Set up the database:
   - Create a new PostgreSQL database
   - Import the database schema (see `database/schema.sql`)

3. Configure environment variables:
   - Copy `.env.example` to `.env`
   - Update the database connection details in `.env`

4. Set proper permissions:
   ```bash
   chmod -R 755 .
   ```

5. Start the development server:
   ```bash
   php -S localhost:8000 -t reminders-app
   ```

6. Open your browser and visit: `http://localhost:8000`

## Database Schema

The application uses the following database tables:

### users
- `id` (SERIAL PRIMARY KEY)
- `username` (VARCHAR(250) UNIQUE NOT NULL)
- `password_hash` (TEXT NOT NULL)
- `is_admin` (BOOLEAN DEFAULT false)

### notes
- `id` (SERIAL PRIMARY KEY)
- `user_id` (INTEGER REFERENCES users(id) ON DELETE CASCADE)
- `subject` (TEXT NOT NULL)
- `created_at` (TIMESTAMP DEFAULT CURRENT_TIMESTAMP)
- `completed` (BOOLEAN DEFAULT false)
- `deleted` (BOOLEAN DEFAULT false)

### log
- `id` (SERIAL PRIMARY KEY)
- `username` (VARCHAR(250) NOT NULL)
- `attempt` (attempt_status NOT NULL) - ENUM('good', 'bad')
- `time` (TIMESTAMP DEFAULT CURRENT_TIMESTAMP)

## Security Features

- Password hashing using PHP's `password_hash()`
- Prepared statements to prevent SQL injection
- Session-based authentication
- Account lockout after 3 failed login attempts
- Secure session handling

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open source and available under the [MIT License](LICENSE).

## Contact

For any questions or feedback, please open an issue on GitHub.
