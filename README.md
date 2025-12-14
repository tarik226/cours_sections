# 📚 Learning Management System (LMS) Platform

## Overview
This project is a **Learning Management System (LMS)** built with **PHP/MySQL**.  
It allows administrators to manage courses and sections, while students can view course details and assigned sections.  
The platform is designed to be simple, maintainable, and extendable.

---

## ✨ Features
- **Course Management**
  - Add, edit, delete courses
  - Store course title, description, and level
- **Section Management**
  - Add, edit, delete sections
  - Assign sections to courses
  - Store section title, content, and position
- **Course Details Page**
  - Displays course information (title, description, level)
  - Lists all sections assigned to the course
- **Reusable Layout**
  - Header and footer files for consistent design
- **Secure Queries**
  - Uses `mysqli` with escaping or prepared statements
- **Clean UI**
  - Simple form design with consistent styling

---

## 🛠️ Technologies Used
- **Backend:** PHP (procedural style with mysqli)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3
- **Server Requirements:**
  - PHP ≥ 7.4
  - MySQL ≥ 5.7
  - Apache/Nginx

---

## 📂 Project Structure
│ ├── config.php # Database connection 
├── header.php # Common header 
├── footer.php # Common footer 
│
├── courses_list.php # List all courses 
├── courses_details.php # Show course details + sections 
├── add_course.php # Form to add a new course 
├── edit_course.php # Form to edit a course 
│ 
├── sections_list.php # List all sections 
├── add_section.php # Form to add a new section 
├── sections_edit.php # Form to edit a section 
├── delete_section.php # Delete a section by ID 
│ 
└── README.md # Documentation
