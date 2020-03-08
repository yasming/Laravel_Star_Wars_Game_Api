# Laravel_Star_Wars_Game_Api

This project make a request to star wars api: https://swapi.co/api/planets/ , and seed the database with the planets information. You can register your self and visit some planet, search for a planet's name, then you will get the all informations from this planet with  the number of visits that this planet had, you also can see the planets that have been visited with theirs visitors and also can see the rank of visitors with the number of planets visited . 

## Prerequisites

```
PHP >= 7.2.5
```

```
Laravel >= 7.0
```

```
Composer
```

```
Guzzle: https://github.com/guzzle/guzzle
```

```
Jwt: https://github.com/tymondesigns/jwt-auth
```

### API Collection


https://www.getpostman.com/collections/88f350abf60d657b8fa5

### Getting Started

- After you clone the project: 

```
composer install
```

```
cp .env.eaxmple .env
```

```
php artisan key:generate
```

```
php artisan jwt:generate
```

```
php artisan migrate
```

```
php artisan db:seed
```

- How to consume the project routes: 

```
POST http://localhost:8000/api/register
```

```
Body: 
```

```
{
    name: "yasmin",
    email: "yasmin@hotmail.com",
    password: "1234"
} 
```

```
Response: 
```

```
{
    "data":{
        "message": "User registered with success"
    }
}
```

```
POST http://localhost:8000/api/login
```

```
Body: 
```

```
{
    email: "yasmin@hotmail.com",
    password: "1234"
} 
```

```
Response:
```

```
{
    "data":{
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTU4MzY4MTQyMCwiZXhwIjoxNTgzNjg1MDIwLCJuYmYiOjE1ODM2ODE0MjAsImp0aSI6InpJQWp2UDliaXJPd0pPcloiLCJzdWIiOjYxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.OFPCI4mXz0mhRGbAuIZcovLvXVJjd3rlByFzfFuqOYY",
        "user": {
            "id": 61,
            "name": "yasmin",
            "email": "yasmin@hotmail.com"
        }
    }
}
```

- Pay Attention !! 
- Before access this follow routes, you need to put the token that were recivied in authentication in Bearer Token on postman !

```
POST localhost:8000/api/planets/visit/4
```

```
Response:
```

```
{
    "data": {
        "message": "You visited the planet: Hoth"
    }
}
```

```
POST localhost:8000/api/planets/search
```

```
Body:
```

```
{
    name: "alderaan"
}
```

```
Response:
```

```
{
    "data": {
        "id": 4,
        "name": "Hoth",
        "rotation_period": "23",
        "orbital_period": "549",
        "diameter": "7200",
        "climate": "frozen",
        "gravity": "1.1 standard",
        "terrain": "tundra, ice caves, mountain ranges",
        "surface_water": "100",
        "population": "unknown",
        "residents": [
            ""
        ],
        "films": [
            "https://swapi.co/api/films/2/"
        ],
        "created": "2014-12-10T11:39:13.934000Z",
        "edited": "2014-12-20T20:58:18.423000Z",
        "url": "https://swapi.co/api/planets/4/",
        "number_of_visits": 1
    }
}
```

```
GET localhost:8000/api/planets/visitors
```

```
Response:
```

```
{
    "data": {
        "id": 4,
        "name": "Hoth",
        "rotation_period": "23",
        "orbital_period": "549",
        "diameter": "7200",
        "climate": "frozen",
        "gravity": "1.1 standard",
        "terrain": "tundra, ice caves, mountain ranges",
        "surface_water": "100",
        "population": "unknown",
        "residents": [
            ""
        ],
        "films": [
            "https://swapi.co/api/films/2/"
        ],
        "created": "2014-12-10T11:39:13.934000Z",
        "edited": "2014-12-20T20:58:18.423000Z",
        "url": "https://swapi.co/api/planets/4/",
        "number_of_visits": 1
    }
}
```

```
GET localhost:8000/api/planets/visitors/ranking
```

```
Response:
```

```
{
    "data": [
        {
            "id": 61,
            "name": "yasmin",
            "email": "yasmin@hotmail.com",
            "number_of_planets_visited": 1
        },
        {
            "id": 21,
            "name": "Dr. Camila Jast Jr.",
            "email": "aniyah29@hotmail.com",
            "number_of_planets_visited": 0
        },
        ...
    ]
}
```
