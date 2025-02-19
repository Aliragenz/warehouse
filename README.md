# Warehouse Management System

## 📦 About the Project
This Warehouse Management System helps administrators track and manage stock movement efficiently. The system provides an intuitive dashboard for monitoring customers, stock going in and out, and supplier details.

## 🚀 Features
- 🔑 Admin authentication
- 📊 Dashboard with real-time data
- 📦 Track stock going in and out
- 🏢 Manage suppliers and customers
- 📜 Role-based access control

## 🛠️ Tech Stack
- **Backend:** Laravel, MySQL
- **Frontend:** Blade, Bootstrap
- **Icons:** Font Awesome
- **Authentication:** Laravel Auth Middleware

## 📂 Installation

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/yourusername/warehouse-management.git
cd warehouse-management
```

### 2️⃣ Install Dependencies
composer install
npm install

### 3️⃣ Configure Environment
Copy .env.example to .env and update your database credentials:
cp .env.example .env

Then, generate the application key:
php artisan key:generate
### 4️⃣ Run Database Migrations
php artisan migrate

### 5️⃣ Serve the Application
php artisan serve

📜 License
This project is licensed under the MIT License.
