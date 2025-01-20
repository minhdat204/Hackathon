# HACKATHON CDTH22WEBB
## Project Features

The Hackathon_CDTH22WEBB project includes several key features that enhance user interaction and functionality:

1. **User Authentication**:
   - Users must log in to access the application. This ensures that personal data and interactions are secure.
2. **User Registration:**
    - Sign-up form includes fields like Username, Password, Confirm Password, Name, Birthday.
    - Access to core app features after successful registration.
3. **Home Page**:
   - After successful login, users are directed to the home page, which includes the following features:
     - **Comments Section**: Users can leave comments, enabling discussions and feedback on various topics.
     - **Voting Button**: Users can participate in polls or votes, contributing to decision-making processes or preferences.
     - **Logout Option**: Users can easily log out of their accounts when they finish their session.

4. **User Profile Management**:
   - A dedicated section for users to update their personal information, ensuring that their profiles are current and accurate. This feature enhances user experience by allowing personalization and easy management of user details.

Feel free to explore the application and take advantage of these features!

## Requirements

- **PHP:** >= 8.0
- **Composer:** >= 2.0
- **Node.js:** >= 12.x (for Laravel Mix)
- **Database:** MySQL

## Getting Started

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/minhdat204/hackathon.git
   cd hackathon
2. **Install dependencies**
   ```bash
   composer install
3. **Copy the .env file Create a copy of the .env.example file and rename it to .env:**
    ```bash
   cp .env.example .env
4. **Generate application key**
    ```bash
   php artisan key:generate
5. **Run migrations Create the database tables by running migrations:**
    ```bash
    php artisan migrate
    php artisan db:seed
6. **Install Node.js dependencies (optional)**
    ```bash
    npm install
    npm run dev
7. **Serve the application Start the Laravel development server:**
    ```bash
    php artisan serve
Then, visit http://localhost:8000 to view the application.

