# Laravel EMI Processing Task

This project is the assignment for the **Junior Laravel Developer** role.  
It demonstrates migrations, seeders, authentication, repository/service pattern, and an EMI processing module with RAW SQL.

---

## 🛠 Requirements
- PHP 8+
- Composer
- MySQL 8+ (running on port 3307 in this setup)
- Node.js & NPM (optional, for frontend assets)

---

## ⚙️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/emi-task-project.git
   cd emi-task-project

2. Install dependencies
    composer install

3. Environment file
Copy .env.example to .env and update database credentials:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3307
    DB_DATABASE=emi_task
    DB_USERNAME=root
    DB_PASSWORD=

4. Generate application key

   php artisan key:generate

6. Run migrations & seeders

  php artisan migrate:fresh --seed

7. Login Crendentials

   Username: developer
   Password: Test@Password123#

9. start the server
php artisan serve


