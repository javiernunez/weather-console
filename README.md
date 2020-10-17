# Weather Console Application

## Pre-installation Requirements
In order to run this application you need to have `docker` and `docker-compose` installed in your computer.

You can install docker from [https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/)

## Installation Instructions
To install this app you need to run:

```
`docker compose up -d`
```

This will create a Docker container with all required libraries and applications. Also, it will install all composer dependencies in the project.

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

## NOTES ABOUT ARQUITECTURE AND DECISSIONS TAKEN

###  STORAGE AND CACHE
- In order to have a scalable application, we could store the information we are gathering from the API and store it in a cache system (Redis, for example) that will serve for high requested locations.

### INTERFACES BUILT WITH ABSTRACT INSTEAD INTERFACES

To be able to type hint the interface in the Controller, I decided to build the weather service interface as an abstract class so it can be extended and type hinted (and injected)

### TEMPERATURE UNIT AS VALUE OBJECT
I could have modeled the TEMPERATURE UNIT as a Value Object, but given that this is just a sample project, I didn't do it for simplicity.

## LOCATION AND WEATHER SUMMARY MODELING
I didn't model Location and Weather Summary for simplicity.

## WHY THE LACK OF DOCUMENTATION IN THE CODE?
I am a defender of code explaining itself, so I hope you don't need any code documentation to understand how all is working.
