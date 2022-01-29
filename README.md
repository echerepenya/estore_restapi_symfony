# estore_restapi_symfony

REST API with custom CRUD endpoints
======
Simple REST API as a international backend that can be used by multiple online stores over the world. It allows any connected clients to get an information in convenient JSON format for further processing

Click [HERE](http://92.244.114.8/) to see live demo
---
Available options for getting an information

* **Search for the full details on particular product including its net price, VAT and gross price by product ID and locale code**
* Product range. Product's name, description, price and a Category. These parameters are the same for all regions
* List of locale languages, ISO-639-1 codes and corresponding Countries
* List VAT rates are related to Countries and product's Categories
---

The progect is built with Symfony PHP framework, including Doctrine db manager and API Platform

The scheme of entities relation:
![Relations scheme](/assets/entities-relation.jpg)

All entities are available as standard API Platform CRUD endpoints. They are fully functional for getting and updating data, including nested entities update

In addition to this, custom endpoint **Search** was designed to do search by two conditions (product's ID and locale's code). It uses POST method to get json data and accepts two variables as an input. If it receives both variable equal to 0 (zero), endpoint returns full list of products and VAT rates for all available countries. Data Transfer Objects and DataPersistentInterface are used for custom endpoint design (it really wasn't easy to find a solution to make custom endpoint not related to any entity)
![API - Search](/assets/api-screenshot.jpg)

To simplify reading of values of main enities, simple dashboard panel was made. It is available at main page of the site. Main menu with all links are on the TOP panel

![Dashboard screenshot](/assets/dashboard.jpg)
---

Input data validation and restriction
------

VAT - not empty, numbers from 0 to 20  
All names - not empty, unique, string  
Product description - string, up to 1000 symbols

Deployment
------

* you need a Docker and Composer to be installed
* download this repository as .zip file and extract it to one folder
* open a shell and go to new folder prom previous step
* run "docker-compose up -d"
* open _localhost:8100_ in your browser
* enjoy!