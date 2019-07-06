# README

## Description
My first integration using **Foursquare** and **Vue.js**. After spent some times studiyng AngularJS, I turned my attention to Vue.js and I used Foursquare Api to make a little experiment.

## Getting started
* Clone the repository to create a local copy on your computer and set up a virtual host to visit VueSquare via browser.
* Open conf/global.json and put your [Foursquare Client ID and Client Secret keys](https://developer.foursquare.com/docs/api).
* Open VueSquare via browser.

## Beneath the surface
* Javascript gets the coordinates of the user (if the user allows that);
* PHP connects VueSquare with Foursquare througt a Foursquare wrapper class; 
* JQuery makes Ajax calls;
* Bootstrap builds a basic layout.

## Cases
I implemented two cases:
- localization accepted by the user: navigator automatically get the current position and performing an ajax call to retrieve a list of venues from Foursquare, near to the current position; user can click on venue name to get the details of the venue like name, id, image and numbers of likes;
- localization **NOT** accepted by the user: a form with a text input will be presented to the user to insert a city name and get a list of venues; user can click on venue name to get the details of the venue (same behaviour of #1);

There are a couple of lacks: a "loading" message still on the screen in the second case (localization NOT accepted) and (always on the second case) the form disappears when the user clicks on the venue details. But this is just a demo!  ¯\_(ツ)_/¯

## Stack
- Foursquare API
- PHP
- Vue.js
- JQuery
- Bootstrap.

Tested on PHP 5.4.44 and 7.1.20

## Live demo
[Real integration in WordPress](https://www.giuseppemaccario.com/foursquare-integration/)

## Screenshot
![VueSquare - G.Maccario](https://github.com/gmaccario/vuesquare/blob/master/screenshot.png?raw=true)