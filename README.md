# Series-Hub
![Series-Hub](serieshub.gif)

## 📌 Overview

Series-Hub is a web platform that allows users to explore the highest-rated TV series. It includes key features such as:

- Genre-based filtering
- Pagination
- Search bar
- Series synopsis
- Responsive design

The project is divided into frontend and backend, both deployed separately. The backend consumes an external RESTful API from **The Movie Database (TMDb)** and includes **unit and feature tests** to ensure code reliability.

## 🚀 Live Demo

Check out the live project:

-  [Series-Hub Live](https://series-hub-lime.vercel.app/)

---

## 💻 Technologies

### **Frontend:**

- React.js
- React Router
- Axios
- Bootstrap
- Vercel (for deployment)

### **Backend:**

- Laravel (PHP framework)
- PHPUnit (unit and feature testing)
- MySQL
- Laravel Eloquent ORM
- Laravel API Resource

---

## 📜 API Endpoints

### **Series Routes**

| Route                                               | Method | Description                      |
| --------------------------------------------------- | ------ | -------------------------------- |
| `/series/discover?page={page}&with_genres={genres}` | GET    | Get series by genre              |
| `/series/search?page={page}&query={query}`          | GET    | Search series by title           |
| `/series/`                                          | GET    | Get all series with pagination   |
| `/series/{serieId}`                                 | GET    | Get details of a specific series |

---

## 🛠️ Installation & Setup

### **Prerequisites**

Ensure you have the following installed:
- **Laragon (recommended for easy Laravel setup) (Windows only)**
- **PHP 8+**
- **Composer**
- **MySQL**
- **Git**

### **Cloning the Repository**

```bash
git clone https://github.com/Matheus-A-Paiva/series-hub.git
cd series-hub
```

### **Backend Setup (Laravel)**

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### **Frontend Setup (React)**

```bash
cd frontend
npm install
npm run dev
```

---

## 🧪 Running Tests

### **Backend (Laravel PHPUnit Tests)**

```bash
php artisan test
```
---

## 📬 Contact

For any questions, feel free to reach out:

- **Email:** [emanuelmatheus948@gmail.com](mailto:emanuelmatheus948@gmail.com)
- **GitHub Issues:** [Open an issue](https://github.com/Matheus-A-Paiva/series-hub/issues)

