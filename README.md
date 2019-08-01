# README

## Description
My first integration using **Foursquare** and **Vue.js**. After spent some times studiyng AngularJS, I turned my attention to Vue.js and I used Foursquare Api to make a little experiment.

## Getting started
* Clone the repository to create a local copy on your computer and set up a virtual host to visit VueSquare via browser.
* Open conf/config.php and put your [Foursquare Client ID and Client Secret keys](https://developer.foursquare.com/docs/api).
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

## TODO
- Add live filters
- Gets the form (second case, no geolocation activated) always displayed on the page

## Live demo
[Real integration in WordPress](https://www.giuseppemaccario.com/foursquare-integration/)

## Screenshot
![VueSquare - G.Maccario](https://github.com/gmaccario/vuesquare/blob/master/screenshot.png?raw=true)