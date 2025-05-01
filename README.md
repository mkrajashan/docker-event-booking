# Event Booking API (Dockerized Laravel App)

**Dockerized Laravel REST API** for an Event Booking System, supporting:

- **Events**: CRUD for events
- **Attendees**: CRUD for attendees
- **Bookings**: CRUD for event bookings
- **Authentication**: Token-based API (Laravel Sanctum)

---

## Quick Start

### Clone & Setup

git clone <your-repo-url>
cd event-booking-api
Make sure DB settings in .env match docker-compose.yml

## DB config check in .env file
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=event_booking_api
DB_USERNAME=root
DB_PASSWORD=root

## Run Docker
docker-compose up -d --build

## Laravel app
http://127.0.0.1:8003/api/events

## PHPMyadmin
http://127.0.0.1:8080
if phpmyadmin is not working, then 

use this docker command:-
docker exec -it event-booking-db bash

## Setup DB
docker exec -it event-booking-app php artisan migrate

## Seed Data
docker exec -it event-booking-app php artisan db:seed

## Test
docker exec -it event-booking-app php artisan test


