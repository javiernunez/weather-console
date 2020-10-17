# Weather Console Application

## Pre-installation Requirements
In order to run this application you need to have `docker` and `docker-compose` installed in your computer.

You can install docker from [https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/)

## Installation Instructions

1. Clon the project 

`git clone git@github.com:javiernunez/weather-console.git`

2. Go into the folder project, build image and start the container 

```shell script
cd weather-console
docker-compose up -d`
```

Docker will install all neeeded libraries, dependencies and env configuration for you.

## Running the application
To run the application you need to run:

```shell script
. run weather Madrid
```

## Testing the application
To run PHPUnit tests you need to run:

```shell script
. run tests
```

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
