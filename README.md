# PHP OBS Countdown Script
Simple PHP script to generate a countdown timer for use with OBS live stream.

## Download PHP
You need PHP installed on your system. Download: https://www.php.net/downloads.php

## Configure Timezone
Update the default timezone for your system by editing the top of the counter.php file

## Start the Countdown
Run the counter.php by opening the terminal (mac) or command prompt (windows).
```
php counter.php
```
This will print out the current date and time and exit. Re-run with the time you want the counter to end. This command will start a timer that ends on June 17, 2020 at 7pm PDT.
```
php counter.php 2020-06-17T19:00:00-0700
```
The file `counter.txt` will be written to with the current countdown value. This value also prints out on the console.

## Configure OBS
* Add a new "Text (FreeType 2)" source
* Click browse to select the file `counter.txt` in the Text File row.
* Configure remaining options to alter the display to your liking

You can now place this counter anywhere above your scene and you should see it countdown.
