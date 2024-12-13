# OpenCart Basic HTTP authorization
[![License: GPLv3](https://img.shields.io/badge/license-GPL%20V3-green?style=plastic)](LICENSE)

The extension implements basic HTTP authorization management for the administrative section of the site. HTTP authorization is an access control system built into the server. It will help protect the administrative panel from prying eyes and brute force passwords. This extension is presented as an alternative to manually implementing HTTP authorization.

## Other Languages

* [Russian](README_RU.md)

## Change Log

* [CHANGELOG.md](docs/CHANGELOG.md)

## Screenshots

* [SCREENSHOTS.md](docs/SCREENSHOTS.md)

## Advantages

* You don't have to edit .htpasswd each time to add a user or change a password.
* Automatic password encryption.
* Doesn't remove your code from admin/.htaccess, but neatly rewrites your block.

## Features

The extension will allow:

* Create an unlimited number of users for authorization without first encrypting the password using third-party services.
* Set an exclusion list in the form of files and folders. You can use masks.

## Compatibility

* OpenCart 2.3, 3.x, 4.x.
* Apache server.

## Demo

Admin

* HTTP authorization - login admin password admin
* [https://basic-auth.shtt.blog/admin/](https://basic-auth.shtt.blog/admin/) (auto login)

The demo site has a top menu for quick navigation. To check the presence or absence of HTTP authorization for exclusion links, use the incognito mode [Ctrl+Shift+N].

## Installation

* Install the extension through the standard extension installation section.
* Go to the modules section and install the "Basic HTTP Authorization" module.

## Management

* To enable authorization, enter the desired username and password, separated by a colon. Click Save. Authorization will turn on immediately, so do not forget the password.
* After saving, the password will no longer be displayed in clear text anywhere.
* To add a new user, simply enter login:password, each on a new line, and click save.
* I recommend not using standard logins anywhere, such as "admin", come up with any other.

## License

* [GPL v3.0](LICENSE.MD)

## Thank You for Using My Extensions!

I have decided to make all my OpenCart extensions free and open-source to benefit the community. Developing, maintaining, and updating these extensions takes time and effort.

If my extensions have been helpful for your project and you’d like to support my work, any donation is greatly appreciated.

### 💙 You can support me via:

* [PayPal](https://paypal.me/TalgatShashakhmetov?country.x=US&locale.x=en_US)
* [CashApp](https://cash.app/$TalgatShashakhmetov)

Your support inspires me to keep improving and developing these tools. Thank you!
