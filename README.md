# Event Booking API (Dockerized Laravel App)

**Dockerized Laravel REST API** for an Event Booking System, supporting:

- **Events**: CRUD for events
- **Attendees**: CRUD for attendees
- **Bookings**: CRUD for event bookings
- **Authentication**: Token-based API (Laravel Sanctum)

---

## Quick Start

### Clone & Setup

1. git clone https://github.com/mkrajashan/docker-event-booking.git
2. cd event-booking-api
2.1 php artisan migrate
3. docker-compose up -d --build
4. Make sure DB settings in .env match docker-compose.yml
docker exec -it event-booking-app bash
php artisan config:clear
php artisan cache:clear
php artisan migrate --force

## Run the test cases first( since the Refresh Database will delete the existing records)
php artisan test 

## DB config check in .env file
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=event_booking_api
DB_USERNAME=root
DB_PASSWORD=root

## Laravel app
http://127.0.0.1:8003/api/


## Please follow by step-by-step API, since API Payload are depended on each other.
## 1. Register ( Mandatory )
http://127.0.0.1:8003/api/register
method:POST
use form-data
name    = mani
email    = mani@mani.com
password    = mani@12345
password_confirmation = mani@12345

## 2. Login 
http://127.0.0.1:8003/api/login
method:POST
use form-data
email    = mani@mani.com
password    = mani@12345
Response:-
{
    "access_token": "5|My3BB7NRE8B0rYmdVeW9enRNujFP3AUATnhzancP20b9012f",
    "token_type": "Bearer"
}

## use this access_token for the remaining operation.. 

## 3. Create location ( Mandatory to create event)
http://127.0.0.1:8003/api/locations
{
  "name": "Bangalore West"
}

## 3.1. CRUD location
GET         http://127.0.0.1:8003/api/locations
GET ID      http://127.0.0.1:8003/api/locations/1
DELETE      http://127.0.0.1:8003/api/locations/1
PUT         http://127.0.0.1:8003/api/locations     
Payload:-
{
  "name": "Chennai"
}

## 4. Create Events
Auth Required. 
Auth Type:- Bearer Token
Token:- 5|My3BB7NRE8B0rYmdVeW9enRNujFP3AUATnhzancP20b9012f
Create      

POST        http://127.0.0.1:8003/api/events
PAYLOAD:-
{
    "name": "Tech Conference 2025",
    "description": "Annual technology conference for developers",
    "date": "2024-11-15 09:00:00",
    "location_id": 19,
    "capacity": 500
}

## 4.1. CRUD Events
GET         http://127.0.0.1:8003/api/events
GET ID      http://127.0.0.1:8003/api/events/14
UPDATE      http://127.0.0.1:8003/api/events/13
Auth Required. 
Auth Type:- Bearer Token
Token:- 5|My3BB7NRE8B0rYmdVeW9enRNujFP3AUATnhzancP20b9012f

PAYLOAD:-
{
    "name": "India 2025",
    "description": "India Annual technology conference",
    "date": "2024-11-15 09:00:00",
    "location_id": 19,
    "capacity": 500
}

DELETE      http://127.0.0.1:8003/api/events/13
Auth Required. 
Auth Type:- Bearer Token
Token:- 5|My3BB7NRE8B0rYmdVeW9enRNujFP3AUATnhzancP20b9012f


## 5. Create Attendees
POST        http://127.0.0.1:8003/api/attendees
PayLoad:-
{
    "name": "mani",
    "email": "mani4@mani.com"
}
GET         http://127.0.0.1:8003/api/attendees
GET ID      http://127.0.0.1:8003/api/attendees/8
DELETE      http://127.0.0.1:8003/api/attendees/8
PUT         http://127.0.0.1:8003/api/attendees/9
Payload:-
{
    "name": "mani 99",
    "email" : "mani@mani.com"
}

## 6. Bookings
POST        http://127.0.0.1:8003/api/bookings
PayLoad:-
{
    "attendee_id":10,
    "event_id":15
}
GET         http://127.0.0.1:8003/api/bookings
GET ID      http://127.0.0.1:8003/api/bookings/9
DELETE      http://127.0.0.1:8003/api/bookings/9
PUT         http://127.0.0.1:8003/api/bookings/9
Payload:-
{
    "attendee_id":11,
    "event_id":15
}
## PHPMyadmin
http://127.0.0.1:8080
if phpmyadmin is not working, then 

use this docker command to connect the DB instance and try with mysql -u root -p root:-
docker exec -it event-booking-db bash
php artisan migrate:fresh --seed

## Migrate DB
docker exec -it event-booking-app php artisan migrate

## Seed Data
docker exec -it event-booking-app php artisan db:seed

## Test
docker exec -it event-booking-app php artisan test
php artisan test --env=testing


