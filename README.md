# Library Website Template

A very easy to use and personalize cataloguer website template.

<img src="https://github.com/FabioPezzini/library_website_template/blob/master/img/screen/home_desk.png" width="700"> <img src="https://github.com/FabioPezzini/library_website_template/blob/master/img/screen/home_mob.png" width="200">


[Additional screenshot](img/screen/)

## Highlights
1. Slick and fully __responsive__ design (suitable for mobile).
2. Working __authentication and registration__ form.
3. __Advanced search__ based on custom parameters with high usability.
4. HTML5 & CSS3
5. Possibility to create a personal library in an easy way
6. Easily editable to make it an ecommerce site or integrate ecommerce function

## Requirements
A webserver with PHP(recommended. 7.3.12) & Mysql installed.
Alternatively you can use some stack like [WAMP](https://www.wampserver.com/en/).

## How to use
1. Setup the DB
 - Create a DB named "thecomics" and run the script in the [db folder](db) OR modify the parameters in the [config file to point at your DB](includes/config.php)
 - If you had decided to use a custom DB modify the query in the php files to retrieve the correct data
2. Personalize the [Details page](detail.php) adding all the data that you like
3. Enjoy it

### Warning
The website doesn't include any particoular security prevention, so DON'T use in a production environment without adding it.
To have more information or assistence configuring it, open an issue or contact me.
