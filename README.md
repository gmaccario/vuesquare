# README

## Description
My first integration using Foursquare and Vue.js. After spent some times studiyng AngularJS, I turned my attention to Vue.js and I used Foursquare to make a little experiment with classic ajax calls performed by Jquery.

I used PHP as server side scripting with a Foursquare class implementation; JQuery helps me to do Ajax calls and Bootstrap helps me to buils the basic layout.

There are a couple of lacks: a "loading" message still on the screen in the second case (localization NOT accepted) and the form disappear when I click on the venue details (always on the second case). But this is just a demo!  ¯\_(ツ)_/¯

The application is very simple, I implemented two cases:
- localization accepted by the user: navigator automatically get the current position and performing an ajax call to retrieve a list of venues from Foursquare, near to the current position; user can click on venue name to get the details of the venue like name, id, image and numbers of likes;
- localization NOT accepted by the user: a form with a text input will be presented to the user to insert a city name and get a list of venues; user can click on venue name to get the details of the venue (same behaviour of #1);

## Stack
- Foursquare API
- PHP
- Vue.js
- JQuery
- Bootstrap.

Tested on PHP 5.4.44 and 7.1.20

## Working example
[Real integration in WordPress](https://www.giuseppemaccario.com/foursquare-integration/)

![VueSquare - G.Maccario](https://github.com/gmaccario/vuesquare/blob/master/screenshot.png?raw=true)