# 📁 Electronic Archive System

Welcome to the **Electronic Archive System** – a **secure and efficient** platform that allows **users to upload, search, and retrieve documents**, while **administrators manage users and monitor activities**.

## ✨ Key Features

✅ **User & Admin Roles**: Separate dashboards for users and admins.  
✅ **Secure Authentication**: User registration and login with password hashing.  
✅ **Document Uploading**: Supports PDFs, images (JPG, PNG, GIF), audio (MP3, WAV), videos (MP4), and documents (DOCX, XLS, PPT, TXT).  
✅ **Search & Retrieve**: Find files using metadata, keywords, or filters.  
✅ **File Management**: Store, index, and retrieve archived files efficiently.  
✅ **Admin Controls**: Manage users, monitor uploads, and oversee security.  
✅ **Responsive UI**: Clean and user-friendly interface with CSS.  
✅ **Secure Uploads**: Only allows specified file types with a **50MB limit** to prevent abuse.  

---

## 📂 Folder Structure

```
electronic-archive/
│── index.php           # User & Admin Login Page
│── register.php        # User Registration Page
│── dashboard.php       # User Dashboard
│── admin-dashboard.php # Admin Dashboard
│── manage-users.php    # Admin - Manage Users
│── manage-uploads.php  # Admin - Monitor Uploaded Files
│── upload.php          # Document Upload Page
│── search.php          # Search and Retrieve Page
│── logout.php          # Logout
│── db.php              # Database Connection
│── styles.css          # CSS Styles
│── uploads/            # Folder to store uploaded documents
└── sql-database.sql    # Database Schema
```

---

## 🔧 Installation & Setup

### 1️⃣ **Clone the Repository**
```sh
git clone https://github.com/yourusername/electronic-archive.git
cd electronic-archive
```

### 2️⃣ **Set Up Database**
- Import the `sql-database.sql` file into your MySQL database.
- Update `db.php` with your database credentials.

### 3️⃣ **Run on Localhost**
- Start a local server (XAMPP, WAMP, or MAMP).
- Place the project folder inside `htdocs`.
- Access via `http://localhost/electronic-archive/index.php`.

---

## 🛠 Tech Stack

- **Frontend**: HTML, CSS
- **Backend**: PHP (Procedural)
- **Database**: MySQL
- **Hosting**: Localhost (XAMPP/WAMP) or Online Server

---

## 📜 Usage Guide

1️⃣ **Register/Login**: Users & Admins can sign up and log in.  
2️⃣ **Upload Documents**: Users can upload supported file types.  
3️⃣ **Search Files**: Retrieve archived documents using keywords.  
4️⃣ **Admin Controls**: Manage users and monitor uploads.  
5️⃣ **Secure Logout**: Session handling for security.  

---

## 🎯 Future Improvements
🚀 Multi-user file sharing & permissions.  
🚀 AI-powered document tagging & recommendations.  
🚀 Cloud storage integration.  

---

## 🙌 Contribution
Want to contribute? Feel free to fork, open issues, or submit pull requests!

💡 **Created with ❤️ for easy digital archiving.**

Since admins can’t register through the site, you can manually add them in phpMyAdmin or run this SQL query:

INSERT INTO users (username, email, password, role) 
VALUES ('Admin Name', 'admin@example.com', '$2y$10$hashed_password_here', 'admin');

Replace $2y$10$hashed_password_here with a bcrypt-hashed password. To generate a password hash, use:

echo password_hash("yourpassword", PASSWORD_BCRYPT);

Copy the hashed output and insert it into the database.
