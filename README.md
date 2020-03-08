# Laravel_Nasa_Api_Temperature

This project make a request to nasa api: https://api.nasa.gov/insight_weather/api_key=VKp5faosSlkKrvbDGbL3IuwcHym4kJPMEtiWUWd0&feedtype=json&ver=1.0 , and return the average of temperature of avaiable sols, converted to Fahrenheit . If a query string SOL is passed, it return the average of temperature of this specif sol .

## Prerequisites

```
PHP >= 7.3.3
```

```
Laravel >= 5.8
```

```
Composer
```

```
Guzzle: https://github.com/guzzle/guzzle
```

### Getting Started

- First command when you clone the project: 

```
composer update
```

- How to consume the project routes: 

```
GET localhost:8000/api/temperature
```

```
Response: 
```
```
[
    {
        "sol": "405",
        "averageTemperature": -83.4538
    },
    {
        "sol": "406",
        "averageTemperature": -81.86800000000001
    },
    {
        "sol": "407",
        "averageTemperature": -84.1144
    },
    {
        "sol": "408",
        "averageTemperature": -82.939
    },
    {
        "sol": "409",
        "averageTemperature": -81.1768
    },
    {
        "sol": "410",
        "averageTemperature": -90.80139999999999
    },
    {
        "sol": "411",
        "averageTemperature": -80.6872
    }
]
```

```
GET localhost:8000/api/temperature?SOL=405
```

```
Response:
```

```
{
  "sol": "405",
  "averageTemperature": -83.4538
}
```
