Very simple tool to help cache outside API files to a local backup, includes error catching for failing to update the file in real time, additional catching needed.

Uses cURL to function, the benefit is that using curl to grab APIs offsite will work so much faster than if you tried file_get_contents

I made this mainly for the steam API, but I'm sure you can find a use anywhere, I can help you if you want! Just ask!

function loadCurlFile($cURL,$cache_url,$max_cachetime,$suppress_warnings)

cURL = Your API link

cache_url = the location and name of file to cache to "assets/cache/whatever.json.cache"

max_cachetime (optional) = if you want a cache time longer than the default (60 minuteS)

suppress_warnings = (0/1) , if you want to turn off the optional warning message for failing to recover a file

SUGGESTED : 

whatever you have the file return, you should do an "if(empty($whatever))" that way you can have a neat little error report on your page. 