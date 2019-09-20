# juneapp/php-sdk

A basic SDK to interact with the JUNE automation.

## Description

The JUNE PHP SDK is a small collection of tools to create an easier way to interact with the JUNE automation service.

It contains several prebuilt functions which can be used as a foundation to connect to automation lists. 

### Dependencies

* PHP 7.*

### Installing

```composer require juneapp/php-sdk```

### Usage 

Create a new Client which uses the JWT-Token as an argument.

The token contains a project key, so it can only be used for one project.

For another project, a new token has to be generated.

