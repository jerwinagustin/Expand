# 💰 Expand - Personal Expense Tracker

A modern, full-featured expense tracking web application built with **CodeIgniter 4** and **MySQL**. Expand helps users manage their monthly budgets, track expenses across categories, and visualize spending patterns through an intuitive dashboard.

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-EF4223?style=flat&logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

---

## 🎯 Features

### 🔐 Authentication System

- **Secure User Registration** - Password hashing with PHP's `password_hash()`
- **Login/Logout** - Session-based authentication
- **Form Validation** - Server-side validation for all inputs
- **CSRF Protection** - Built-in CodeIgniter CSRF tokens

### 💼 Wallet Management

- **Monthly Balance Tracking** - Set and track monthly budgets
- **Available Balance** - Real-time calculation of remaining funds
- **Income Tracking** - Record income transactions
- **Balance History** - View past monthly balances

### 📊 Expense Categories

- **Custom Categories** - Create personalized expense categories
- **Budget Allocation** - Set budgets for each category
- **Icon Selection** - Choose from Boxicons for visual identification
- **Category Management** - Full CRUD operations (Create, Read, Update, Delete)
- **Spending Tracking** - Real-time tracking against category budgets

### 💸 Expense Recording

- **Quick Entry** - Fast expense recording with date selection
- **Category Assignment** - Link expenses to specific categories
- **Description Notes** - Add details to each transaction
- **Automatic Updates** - Wallet balance updates automatically
- **Transaction History** - Complete audit trail of all expenses

### 📈 Reports & Analytics

- **Visual Dashboard** - Overview of spending patterns
- **Category Breakdown** - See spending by category
- **Monthly Trends** - Track expenses over time (6-month view)
- **Budget vs. Actual** - Compare planned vs. actual spending
- **Transaction Log** - Detailed transaction history

### 🎨 User Interface

- **Dark/Light Mode** - Toggle between themes
- **Responsive Design** - Mobile-friendly Bootstrap 5 layout
- **Modern UI** - Clean design with gradient accents
- **Interactive Charts** - Visual representation of data
- **Real-time Updates** - AJAX-powered dynamic content

---

## 🏗️ Architecture & Technical Details

### **MVC Pattern**

The application follows CodeIgniter 4's **Model-View-Controller (MVC)** architecture:

```
app/
├── Controllers/         # Request handlers and business logic
│   ├── Auth.php        # Authentication (login, register, logout)
│   ├── Dashboard.php   # Main dashboard
│   ├── Home.php        # Home page with wallet overview
│   ├── Expense.php     # Expense and category management
│   └── Pages.php       # Additional pages (transactions, reports)
├── Models/             # Database interactions
│   ├── UserModel.php       # User authentication and management
│   ├── ExpenseModel.php    # Expense categories and tracking
│   └── WalletModel.php     # Wallet and balance management
├── Views/              # Presentation layer (HTML/PHP templates)
│   ├── Login.php
│   ├── Register.php
│   ├── Home.php
│   ├── Expense.php
│   ├── Transaction.php
│   ├── Report.php
│   └── Settings.php
└── Config/             # Application configuration
    ├── Database.php    # Database connection
    ├── Routes.php      # URL routing
    └── App.php         # Application settings
```

### **Database Schema**

The application uses **5 normalized tables** with proper foreign key relationships:

#### **Users Table**

```sql
- UserID (PK, Auto Increment)
- Username (Unique)
- Email (Unique)
- Password (Hashed)
```

#### **Expense_Categories Table**

```sql
- CategoryID (PK, Auto Increment)
- UserID (FK → Users)
- CategoryName
- Icon (Boxicon class name)
- Budget (Decimal)
- Description
- CreatedAt, UpdatedAt (Timestamps)
```

#### **Expenses Table**

```sql
- ExpenseID (PK, Auto Increment)
- CategoryID (FK → Expense_Categories)
- UserID (FK → Users)
- Amount (Decimal)
- Description
- ExpenseDate (Date)
- CreatedAt, UpdatedAt (Timestamps)
```

#### **Transactions Table**

```sql
- TransactionID (PK, Auto Increment)
- UserID (FK → Users)
- Type (ENUM: 'income', 'expense')
- Amount (Decimal)
- CategoryID (FK → Expense_Categories, nullable)
- Description
- TransactionDate (Date)
- CreatedAt, UpdatedAt (Timestamps)
```

#### **Wallet Table**

```sql
- WalletID (PK, Auto Increment)
- UserID (FK → Users)
- Balance (Decimal)
- Month (Date - first day of month)
- Description
- CreatedAt, UpdatedAt (Timestamps)
- UNIQUE KEY: (UserID, Month)
```

**Foreign Key Relationships:**

- All tables cascade on delete (when user is deleted, all related data is removed)
- Transactions allow NULL CategoryID (for income without category)
- Proper indexing on all foreign keys for query performance

### **Security Features**

- ✅ **Password Hashing** - Bcrypt with `PASSWORD_DEFAULT`
- ✅ **CSRF Protection** - Token validation on all forms
- ✅ **SQL Injection Prevention** - Query Builder with parameter binding
- ✅ **XSS Protection** - Output escaping in views
- ✅ **Session Management** - Secure session handling
- ✅ **Input Validation** - Server-side validation rules
- ✅ **Authentication Guards** - Login checks on protected routes

### **Key Technologies**

- **Backend Framework:** CodeIgniter 4.x (PHP 8.1+)
- **Database:** MySQL 8.0+ / MariaDB
- **Frontend:** Bootstrap 5.3, Boxicons, Google Fonts (Poppins)
- **JavaScript:** Vanilla JS with Fetch API for AJAX
- **Architecture:** MVC Pattern
- **Authentication:** Session-based
- **Validation:** CodeIgniter built-in validation

---

## 🚀 Installation & Setup

### **Prerequisites**

- PHP 8.1 or higher
- MySQL 8.0+ or MariaDB 10.4+
- Composer (PHP dependency manager)
- Web server (Apache/Nginx) or PHP built-in server

### **Step 1: Clone the Repository**

```bash
git clone https://github.com/jerwinagustin/Expand.git
cd Expand
```

### **Step 2: Install Dependencies**

```bash
composer install
```

### **Step 3: Environment Configuration**

```bash
# Copy the example environment file
cp .env.example .env

# Edit .env file and configure:
# - CI_ENVIRONMENT = development
# - app.baseURL = 'http://localhost:8080/'
# - Database credentials (hostname, database, username, password)
```

Example `.env` configuration:

```env
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = expand
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### **Step 4: Database Setup**

```bash
# Create the database
mysql -u root -p

CREATE DATABASE expand;
exit;

# Import the schema
mysql -u root -p expand < expand.sql
```

Or using phpMyAdmin:

1. Create a new database named `expand`
2. Import the `expand.sql` file

### **Step 5: Run the Application**

**Option A: Using PHP Built-in Server**

```bash
php spark serve
```

Then visit: `http://localhost:8080`

**Option B: Using XAMPP/WAMP/MAMP**

1. Copy project to `htdocs` or `www` folder
2. Update `app.baseURL` in `.env` to match your local path
3. Visit: `http://localhost/Expand/public/`

**Option C: Using Apache/Nginx**

- Configure virtual host pointing to `public/` directory
- Ensure `.htaccess` is enabled (Apache)
- Restart web server

---

## 📖 Usage Guide

### **First Time Setup**

1. **Register Account**

   - Navigate to `/signup`
   - Enter username, email, and password
   - System will hash password and create account

2. **Login**

   - Use registered credentials
   - Session will be created

3. **Set Monthly Budget**

   - Go to Home page
   - Click "Add Balance"
   - Enter your monthly budget amount

4. **Create Expense Categories**

   - Navigate to Expense page
   - Click "Add Category"
   - Set category name, budget, icon, and description

5. **Record Expenses**
   - Click on a category
   - Enter amount, date, and description
   - Expense will be deducted from wallet

### **Navigation**

- **Home** - Wallet overview and balance management
- **Expense** - Manage categories and record expenses
- **Transaction** - View all income and expense history
- **Report** - Analytics and spending insights
- **Settings** - User preferences (theme toggle)

---

## 🧪 Testing

### **Manual Testing Checklist**

- [ ] User registration with validation
- [ ] User login/logout
- [ ] Add monthly balance
- [ ] Create expense category
- [ ] Update expense category
- [ ] Delete expense category
- [ ] Record expense
- [ ] View transactions
- [ ] Check wallet balance updates
- [ ] Test date range filters
- [ ] Verify CSRF protection
- [ ] Test dark/light mode toggle

### **Database Testing**

```bash
# Check foreign key constraints
# Try deleting a user and verify cascading deletes
# Test unique constraints (email, username)
# Verify transaction integrity
```

---

## 📁 Project Structure

```
Expand/
├── app/
│   ├── Config/              # Configuration files
│   ├── Controllers/         # Application controllers
│   ├── Models/              # Database models
│   ├── Views/               # HTML templates
│   └── Database/
│       ├── Migrations/      # Database migrations
│       └── Seeds/           # Database seeders
├── public/                  # Public web root
│   ├── index.php           # Front controller
│   ├── .htaccess           # Apache rewrite rules
│   └── assets/
│       ├── css/            # Custom stylesheets
│       └── js/             # JavaScript files
├── system/                  # CodeIgniter 4 core files
├── writable/               # Logs, cache, uploads
│   ├── cache/
│   ├── logs/
│   └── session/
├── .env                    # Environment configuration (not in git)
├── .env.example           # Example environment file
├── composer.json          # PHP dependencies
├── expand.sql             # Database schema
├── spark                  # CLI tool
└── README.md             # This file
```

---

## 🔧 Configuration Files

### **Important Configurations**

**app/Config/Database.php**

- Database connection settings
- Can be overridden by `.env` file

**app/Config/Routes.php**

- URL routing definitions
- Maps URLs to controller methods

**app/Config/App.php**

- Base URL configuration
- Index file settings
- Timezone, locale settings

**app/Config/Filters.php**

- CSRF, CORS, and other filter configurations

---

## 🐛 Troubleshooting

### **Common Issues**

**1. Database Connection Error**

```
Solution: Check .env database credentials
Verify MySQL service is running
Ensure database 'expand' exists
```

**2. 404 Page Not Found**

```
Solution: Check .htaccess in public folder
Verify app.baseURL in .env matches your URL
Enable mod_rewrite in Apache
```

**3. CSRF Token Mismatch**

```
Solution: Clear browser cookies and cache
Check that csrf_field() is in forms
Verify session is working
```

**4. Permission Denied (writable folder)**

```bash
# Linux/Mac
chmod -R 777 writable/

# Windows
# Give full permissions to writable folder
```

---

## 👨‍💻 Development

### **Code Style**

- Follows PSR-12 coding standards
- CodeIgniter 4 naming conventions
- Meaningful variable and function names
- Comments for complex logic

### **Best Practices Implemented**

- ✅ MVC architecture separation
- ✅ DRY (Don't Repeat Yourself) principle
- ✅ Input validation and sanitization
- ✅ Prepared statements (SQL injection prevention)
- ✅ Password hashing (never store plain text)
- ✅ Session-based authentication
- ✅ Error handling and logging
- ✅ Responsive design
- ✅ RESTful API design patterns

### **Extending the Application**

**Add New Controller:**

```php
<?php
namespace App\Controllers;

class NewController extends BaseController
{
    public function index()
    {
        return view('new_view');
    }
}
```

**Add New Model:**

```php
<?php
namespace App\Models;

use CodeIgniter\Model;

class NewModel extends Model
{
    protected $table = 'table_name';
    protected $primaryKey = 'id';
    protected $allowedFields = ['field1', 'field2'];
}
```

**Add New Route:**

```php
// app/Config/Routes.php
$routes->get('new-page', 'NewController::index');
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👤 Author

**Jerwin Agustin**

- GitHub: [@jerwinagustin](https://github.com/jerwinagustin)
- Email: jerwinagustin200@gmail.com

---

## 🙏 Acknowledgments

- **CodeIgniter 4** - Modern PHP framework
- **Bootstrap 5** - Responsive CSS framework
- **Boxicons** - Beautiful icons
- **Google Fonts** - Poppins font family

---

## 📞 Contact & Support

For questions, issues, or feedback:

- 📧 Email: [Work Email](jerwinagustin200@gmail.com)
- 🐛 Issues: [GitHub Issues](https://github.com/jerwinagustin/Expand/issues)

---

## 📊 Project Statistics

- **Language:** PHP 8.1+
- **Framework:** CodeIgniter 4
- **Database:** MySQL
- **Lines of Code:** ~3000+
- **Controllers:** 5
- **Models:** 3
- **Views:** 8
- **Database Tables:** 5

---

## 🎓 For Recruiters

This project demonstrates:

### **Technical Skills**

- ✅ PHP 8.1+ with OOP principles
- ✅ CodeIgniter 4 framework expertise
- ✅ MySQL database design and optimization
- ✅ MVC architecture implementation
- ✅ RESTful API design patterns
- ✅ Frontend development (HTML5, CSS3, JavaScript, Bootstrap 5)
- ✅ AJAX and asynchronous programming
- ✅ Security best practices (authentication, authorization, CSRF, XSS prevention)
- ✅ Session management
- ✅ Form validation (client & server-side)
- ✅ Database relationships and foreign keys
- ✅ Git version control

### **Software Engineering Practices**

- ✅ Clean code principles
- ✅ Code organization and structure
- ✅ Documentation (inline comments, README)
- ✅ Error handling and logging
- ✅ Configuration management
- ✅ Separation of concerns
- ✅ DRY (Don't Repeat Yourself)
- ✅ SOLID principles awareness

### **Problem-Solving Abilities**

- ✅ Requirements analysis (expense tracking system)
- ✅ Database schema design (normalized structure with relationships)
- ✅ User experience design (intuitive interface)
- ✅ Real-time calculations (balance tracking, budget management)
- ✅ Data visualization (reports, charts)
- ✅ State management (sessions, wallet balance)

### **Project Highlights**

1. **Full-Stack Development** - Complete application from database to UI
2. **Security First** - Implemented industry-standard security practices
3. **Scalable Architecture** - MVC pattern allows easy feature additions
4. **User-Centric Design** - Clean, responsive interface with dark mode
5. **Production-Ready** - Proper error handling, validation, and logging

---

## 🚀 Future Enhancements

Potential features for future development:

- [ ] Multi-currency support
- [ ] Recurring expenses automation
- [ ] Budget alerts and notifications
- [ ] Export reports (PDF, Excel)
- [ ] Data visualization charts (Chart.js)
- [ ] Mobile app (PWA or React Native)
- [ ] Bank account integration
- [ ] Bill reminders
- [ ] Expense sharing between users
- [ ] Machine learning for expense predictions
- [ ] REST API for third-party integrations
- [ ] Two-factor authentication (2FA)
- [ ] Email notifications
- [ ] Receipt upload and OCR
- [ ] Advanced analytics and forecasting

---

**Built with ❤️ by Jerwin Agustin**

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the _public_ folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's _public_ folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter _public/..._, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [_Contributing to CodeIgniter_](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
>
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
