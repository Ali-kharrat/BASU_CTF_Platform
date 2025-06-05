# BASU CTF Platform

A university-level Capture The Flag (CTF) platform designed for Bu Ali Sina University. This platform integrates Django for authentication and dashboard management, PHP for challenge pages, and Docker for seamless deployment.

---

## 🔧 Features

- User Registration & Login (Django-based)
- Dashboard with score tracking
- Flag submission with validation
- Multi-stage challenges (e.g., `/level1/`, `/level2/`, etc.)
- Visual hints (images/dialogue) embedded in each challenge
- Route-based progression (guessing next paths or submitting flags)

---

## 🚀 Technologies Used

- **Backend:** Django (Python)
- **Challenges:** PHP (Apache)
- **Reverse Proxy:** Nginx
- **Containerization:** Docker, Docker Compose

---

## 🗂 Directory Structure

```
BASU_CTF_Platform/
├── django/                # Django project for login, register, dashboard
├── php/                   # PHP challenges (e.g., /level1/)
├── nginx/                 # Nginx configuration
├── docker-compose.yml     # Docker service definitions
└── README.md
```

---

## 🧪 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/Ali-kharrat/BASU_CTF_Platform.git
cd BASU_CTF_Platform
```

### 2. Build and Run with Docker

```bash
docker-compose up --build
```

### 3. Access the Platform

Go to: [http://localhost](http://localhost)

- Register a user
- Start solving the challenges
- View your score in the dashboard

---

## 🎯 Challenge Design

- Some levels only require URL guessing (no flag needed)
- Other levels require flag submission through the dashboard
- Hints can be hidden in HTML source, images, or dialogues

---

## 🙋‍♂️ Contributions

Want to add your own challenges or improve the platform? Fork the repo and send a pull request!

---
