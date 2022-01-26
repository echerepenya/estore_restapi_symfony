<h1>REST API with custom CRUD endpoints</h1>
<hr>
<p>Simple REST API is a super international backend that can be used by multiple online stores over the world.</p>
<p>It allows to get an information in convenient JSON format by any connected store for further processing. Available options for getting an information</p>
<ul>
    <li><b>Search for the full details on particular product including its net price, VAT and gross price by product ID and locale code</b></li>
    <li>Product range. Product's name, description, price and a Category. These parameters are the same for all regions</li>
    <li>List of locale languages, ISO-639-1 codes and corresponding Countries</li>
    <li>List VAT rates are related to Countries and product's Categories
</ul>
<hr>
<p>The progect is built on Symfony PHP framework, including Doctrine db manager and API Platform. </p>
<p>Standard API Platform CRUD endpoints are fully functional for getting and updating data including nested entities update (@APIPlatform annotations for entities are used).</p>
<p>In addition to this, custom endpoint <b>Search</b> was designed to do search by two conditions (product ID and locale's code). It uses POST method to get json data and waiting two variables as an input. If it receives both variable equal to 0 (zero), endpoint returns full list of products and VAT rates for all available countries. Data Transfer Objects and DataPersistentInterface are used for custom endpoint design</p>

<p>The scheme of entities relation:</p>
<img src='[https://github.com/echerepenya/estore_restapi_symfony/blob/main/public/git_screens/entities-relation.jpg' alt='Entities relation scheme' style='max-width: 50%;'>