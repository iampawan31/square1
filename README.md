## About Task

A customer approached us to build a web blogging platform.

The homepage will show all the blog posts to everyone visiting the web. Any user will be able to register in the platform, login to a private area to see the posts he created and, if they want, create new ones. They won't be able to edit or delete them.

The blog posts will only contain a title, description and publication date. The users should be able to sort them by publication_date.

Also, the customer is using another blogging platform and she wants us to auto import the posts created there and add them to our new blogging platform, for that reason, she provided us the following REST api endpoint that returns the new posts ([https://sq1-api-test.herokuapp.com/posts](https://sq1-api-test.herokuapp.com/posts)). 

The posts from this feed should be saved under a designated, system-created user, 'admin'.

Our customer is a very popular blogger, who generates between 2 and 3 posts an hour. The site which powers the feed linked above is a very popular one (several million visitors a month), and we are expecting a similar level of traffic on our site. One of our goals is to minimise the strain put on our system during traffic peaks, while also minimising the strain we put on the feed server.

## Technologies Used
- Laravel
- Vuejs - Vuex, Router
- Bulma CSS

## Setup

1. Clone the repository to your local machine using ````git clone https://github.com/iampawan31/square1.git.````
2. Run ````composer install```` in home directory.
3. Run ````php artisan migrate```` for executing migration files.
4. Run ````php artisan db:seed```` for seeding dummy data.
5. Run ````npm install```` to install NPM Dependencies.
6. Both frontend and backend should be on the same domain as Laravel Sanctum is used for SPA Authentication.
7. For Test Auto Import Posts from ([https://sq1-api-test.herokuapp.com/posts](https://sq1-api-test.herokuapp.com/posts)), please run ````php artisan schedule:work```` on your terminal in root directory.

## Tests
- Run ````phpunit```` for executing Feature/Unit Tests.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
