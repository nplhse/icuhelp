ICUhelp
=======

This project is intended to provide some useful things to the daily work of physicians on the intensive care unit.

# Requirements

- Webserver (Apache, Nginx, LiteSpeed, IIS, etc.) with PHP 7.4 or higher, mySQL 5.7 and Swiftmail compatible mailer

# Installation
## From GitHub
1. Launch a **terminal** or **console** and navigate to the webroot folder. Clone the ICUhelp repository from [https://github.com/nplhse/icuhelp]() to a folder in the webroot of your server, e.g. `~/webroot/icuhelp`. 

    ```
    $ cd ~/webroot
    $ git clone https://github.com/nplhse/icuhelp.git
    ```
       
2. Install ICUhelp by using **composer**:

    ```
    $ cd ~/webroot/icuhelp
    $ composer install
    ```
3. Setup ICUhelp by using our custom **composer** script (including some demo fixtures for the database):

    ```
    $ composer setup
    ```
   
4. You are ready to go, just open the site with your favorite browser!

# Contributing
Any contribution to ICUhelp is appreciated, whether it is related to fixing bugs, suggestions or improvements. Feel free to take your part in the development of ICUhelp!

However you should follow some simple guidelines which you can find in the [CONTRIBUTING](CONTRIBUTING.md) file.

# License
See [LICENSE](LICENSE.md).
