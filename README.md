
# Event Booking API (Dockerized Laravel App)

A **Dockerized Laravel REST API** for an Event Booking System, supporting:

- **Events**: Full CRUD
- **Attendees**: Full CRUD
- **Bookings**: Full CRUD
- **Authentication**: Token-based (Laravel Sanctum)

---

## 🚀 Quick Start

### 1. Clone & Setup

```bash
git clone https://github.com/mkrajashan/docker-event-booking.git
cd event-booking-api
php artisan migrate
docker-compose up -d --build
```

### 2. Configure Environment

Ensure `.env` DB settings match your `docker-compose.yml`:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=event_booking_api
DB_USERNAME=root
DB_PASSWORD=root
```

### 3. Clear & Migrate

```bash
docker exec -it event-booking-app bash
php artisan config:clear
php artisan cache:clear
php artisan migrate --force
```

---

## ✅ Testing

Run test cases (this will refresh the DB):

```bash
php artisan test
```

---

## 🌐 Laravel App URL

API Base URL: [http://127.0.0.1:8003/api/](http://127.0.0.1:8003/api/)

---

## 🧪 API Usage (Step-by-Step)

> **Note:** Follow the sequence as some payloads are interdependent.

### 1. 🔐 Register (Required)

- **Endpoint:** `POST /api/register`
- **Headers:** `Accept: application/json`
- **Form Data:**

```text
name: mani
email: mani@mani.com
password: mani@12345
password_confirmation: mani@12345
```

---

### 2. 🔓 Login

- **Endpoint:** `POST /api/login`
- **Form Data:**

```text
email: mani@mani.com
password: mani@12345
```

- **Response:**

```json
{
  "access_token": "YOUR_ACCESS_TOKEN",
  "token_type": "Bearer"
}
```

Use this token for authenticated requests.

---

### 3. 📍 Locations

#### 3.1. Create Location (Required for Events)

- **POST /api/locations**

```json
{
  "name": "Bangalore West"
}
```

#### 3.2. Location CRUD

- **GET:** `/api/locations`
- **GET (by ID):** `/api/locations/{id}`
- **PUT:** `/api/locations`

```json
{
  "name": "Chennai"
}
```

- **DELETE:** `/api/locations/{id}`

---

### 4. 📅 Events

> **Requires Auth (Bearer Token)**

#### 4.1. Create Event

- **POST /api/events**

```json
{
  "name": "Tech Conference 2025",
  "description": "Annual technology conference for developers",
  "date": "2024-11-15 09:00:00",
  "location_id": 19,
  "capacity": 500
}
```

#### 4.2. Event CRUD

- **GET:** `/api/events`
- **GET (by ID):** `/api/events/{id}`
- **PUT:** `/api/events/{id}`

```json
{
  "name": "India 2025",
  "description": "India Annual technology conference",
  "date": "2024-11-15 09:00:00",
  "location_id": 19,
  "capacity": 500
}
```

- **DELETE:** `/api/events/{id}`

---

### 5. 👥 Attendees

#### 5.1. Create Attendee

- **POST /api/attendees**

```json
{
  "name": "mani",
  "email": "mani4@mani.com"
}
```

#### 5.2. Attendee CRUD

- **GET:** `/api/attendees`
- **GET (by ID):** `/api/attendees/{id}`
- **PUT:** `/api/attendees/{id}`

```json
{
  "name": "mani 99",
  "email": "mani@mani.com"
}
```

- **DELETE:** `/api/attendees/{id}`

---

### 6. 📖 Bookings

#### 6.1. Create Booking

- **POST /api/bookings**

```json
{
  "attendee_id": 10,
  "event_id": 15
}
```

#### 6.2. Booking CRUD

- **GET:** `/api/bookings`
- **GET (by ID):** `/api/bookings/{id}`
- **PUT:** `/api/bookings/{id}`

```json
{
  "attendee_id": 11,
  "event_id": 15
}
```

- **DELETE:** `/api/bookings/{id}`

---

## 🛠 PHPMyAdmin

- URL: [http://127.0.0.1:8080](http://127.0.0.1:8080)

If not working, use Docker to access MySQL CLI:

```bash
docker exec -it event-booking-db bash
mysql -u root -p
# password: root
```

---

## 🧰 Artisan Commands via Docker

### Run Migrations

```bash
docker exec -it event-booking-app php artisan migrate
```

### Seed Database

```bash
docker exec -it event-booking-app php artisan db:seed
```

### Run Tests

```bash
docker exec -it event-booking-app php artisan test
php artisan test
```
