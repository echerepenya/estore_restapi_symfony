REST API with custom CRUD endpoints
======
Simple REST API as a international backend that can be used by multiple online stores over the world. It allows any connected clients to get an information in convenient JSON format for further processing

Available options for getting an information

* **Search for the full details on particular product including its net price, VAT and gross price by product ID and locale code**
* Product range. Product's name, description, price and a Category. These parameters are the same for all regions
* List of locale languages, ISO-639-1 codes and corresponding Countries
* List VAT rates are related to Countries and product's Categories
---

The progect is built with Symfony PHP framework, including Doctrine db manager and API Platform

Standard API Platform CRUD endpoints are fully functional for getting and updating data, including nested entities update (@APIPlatform annotations for entities are used)

In addition to this, custom endpoint **Search** was designed to do search by two conditions (product ID and locale's code). It uses POST method to get json data and accepts two variables as an input. If it receives both variable equal to 0 (zero), endpoint returns full list of products and VAT rates for all available countries. Data Transfer Objects and DataPersistentInterface are used for custom endpoint design  

The scheme of entities relation:

![Relations](https://github.com/echerepenya/estore_restapi_symfony/blob/main/public/git_screens/entities-relation.jpg)