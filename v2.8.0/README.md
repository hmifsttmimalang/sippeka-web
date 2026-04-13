# SIPPEKA v2.8.0 - Project Migration

A modern, high-performance training management and selection system built with the **Laravel 13 + Livewire 4** stack. This project represents a complete migration from a legacy controller-based architecture to a class-based, reactive Livewire application with a premium "Glass-SaaS" aesthetic.

## 🚀 Quick Start

### 1. Requirements
- PHP 8.4+
- Composer
- Node.js & NPM
- Database (MySQL/SQLite)

### 2. Installation
```bash
# Clone the repository (if not already in it)
# cd v2.8.0

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --seed

# Build assets
npm run dev
```

### 3. Access Credentials (Demo Data)
| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | admin@sippeka.org | `admin123` |
| **Instructor** | pelatih@sippeka.org | `pelatih123` |
| **Student** | peserta@sippeka.org | `peserta123` |

## ✨ Key Features

### 👤 Student Journey
- **Wizard Registration**: Multi-step registration with real-time file upload and validation.
- **Unified Exam Engine**: Smart engine supporting both official **Selection** tests and **Practice Simulations**.
- **Interactive Dashboard**: Track registration status and review practice test performance.

### 🛠️ Administrative Suite
- **Academic Manager**: Full control over Question Titles, Skill Tests, and Question Pools.
- **Evaluation Hub**: Interactive instructor scoring for interviews with auto-grading logic.
- **Professional Reporting**: High-fidelity PDF generation for student registration details.

## 🎨 Tech Stack & Design
- **Core**: Laravel 13 & Livewire 4
- **Styling**: Tailwind CSS with custom "Glass-SaaS" components.
- **Reporting**: Laravel DomPDF
- **Design System**: Indiana indigo, Slate grays, Glassmorphism, and smooth Framer-style animations.

## 📂 Project Structure
- `app/Livewire/Admin`: Administrative management components.
- `app/Livewire/Student`: Student dashboard and exam engine.
- `app/Livewire/Registration`: Multi-step onboarding wizard.
- `app/Http/Controllers/Admin/ReportController`: PDF generation logic.

---
*Maintained by SIPPEKA Engineering Team - 2026*
