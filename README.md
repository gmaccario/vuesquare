# VueSquare v.1.5

## Description
My first integration using **Foursquare** and **Vue.js**. After spent some time studying AngularJS, I turned my attention to Vue.js and I used Foursquare Api to make a little web app that show to the users a list of places closeby them.

## Getting started
* Clone the repository to create a local copy on your computer and set up a virtual host to visit VueSquare via browser.
* Launch composer dump-autoload to regenerate the list of all classes that need to be included in the project 
* Open conf/config.php and put your [Foursquare Client ID and Client Secret keys](https://developer.foursquare.com/docs/api)
* Set up a virtual host (optional)
* Open VueSquare via browser.

## Beneath the surface
* Javascript gets the coordinates of the user if the user allows that
* PHP connects VueSquare to Foursquare APIs through a Foursquare wrapper class
* Axios provides a way to performs Ajax calls
* Bootstrap helps me to build a grid layout
* Autoloader PSR-4 via composer

## Cases
I implemented two cases:
- localization **accepted** by the user: the navigator gets the current position and retrieves a list of categories and venues from Foursquare based on the current position of the user. Then the user can clicks on venue name to get the details of the venue as name, image, number of current people currently visiting the venue, random tips shared by users, contact details and numbers of likes
- localization **NOT accepted** by the user: a form with a text input will be presented to the user to insert a city name and get a list of venues; user can click on venue name to get the details of the venue (same behaviour of #1)

## Stack
- Foursquare API
- PHP 7
- Vue.js
- Axios
- Bootstrap

Tested on PHP 7.1.20

## Dependencies
- [php-foursquare](https://github.com/hownowstephen/php-foursquare)

## Change logs
- v.1.1
- Sort results by distance
- Form when geolocation is not activated
- Installed PSR-4 autoloader
- Installed php-foursquare from Composer
- Refactoring of fs Vuejs
- Implemented EventBus

## TODO
- Add live filters
- Components separation (different files)
- Test Unit for the wrapper

## Live demo
[Real integration in WordPress](https://www.giuseppemaccario.com/foursquare-integration/)

## Screenshot
![VueSquare - G.Maccario](https://github.com/gmaccario/vuesquare/blob/master/screenshot.png?raw=true)