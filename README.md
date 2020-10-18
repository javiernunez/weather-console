# Weather Console Application

## Pre-installation Requirements
In order to run this application you need to have `docker` and `docker-compose` installed in your computer.

You can install docker from [https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/)

## Installation Command

```
git clone git@github.com:javiernunez/weather-console.git && \
cd weather-console && \
docker-compose up -d && \
./run composer install
```

## Commands
- Run the application `./run weather Madrid`
- Run phpunit tests `./run tests`
- Run composer inside the container `./run composer`

## Notes about arquitecture and design choices

###  Storage and Cache
- In order to have a scalable application, we could store the information we are gathering from the API and store it in a cache system (Redis, for example) that will serve for high requested locations.

### Interface build with abstract classes instead of native interfaces

To be able to type hint the interface in the Controller, I decided to build the weather service interface as an abstract class so it can be extended and type hinted (and injected)

### TemperatureUnit as Value Object
I could have modeled the TEMPERATURE UNIT as a Value Object, but given that this is just a sample project, I didn't do it for simplicity.

### Location and WeatherSummary modeling
I didn't model Location and WeatherSummary for simplicity.

### Why the lack of documentation in the code?
I am a defender of code explaining itself. New features like Type hinting and choosing the good naming and structure should be enough to understand the code. So I hope you don't need any code documentation to understand how all is working.

### .env file not ignored
Should be ignored for API key security, for simplicity I left it there.
