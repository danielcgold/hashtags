# hashtags
_Better control over hashtags for Instagram_

This is a simple hashtag tool for specifying which hashtag to choose for your next Instagram post. Hitting the main page gives you a list. Click on the table row to add a hashtag to your list. Copy them at any time.


🤓 Stuff
This takes an array of user generated hashtags (`hashtag-list.php`) and grabs the used count from instagram.com. It has no API calls and requires no dependancies. This is a mini-scrapper. It's not 100% accurate but gives you an idea of how many times a hashtag is used.

When viewing `index.php` you'll see a table of hashtags, with their counts. From there, you can select hashtags and copy them to your clipboard.

## Demo
https://baker-lightning-32664.netlify.com/

## Getting started
* Run this on an apache server
* Hit http://localhost/hashtags.php to compile the hashtags compiled file

## Having trouble?
* Make sure permissions are set as `777`. It's like you won the lottery! 🎰
* The initial build of `hashtags` takes a while. Make get a sandwich?

## Contributing
* Add hashtags into `hashtag-list.php`
* Help with some of the TODOs below ⬇️

## TODO
* Max the selection out at 30 hashtags
* Better way to build the hashtags file (database? faster calls? API? cron job to hit hashtag-list.php?)
* ~~Deploy somewhere~~
* Split out CSS & JS files from index.php
* ~~Build process?~~
* Loading indicator in `hashtags.php`?
* Maybe call `hashtags.php` and have some sort of logic in `index.php` to send the hashtag request with some `$_GET[]` and `$_POST[]` business
