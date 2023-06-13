This is a personal project, using an MVC generated by Symfony. It integrates Symfony 6.3 and PHP 8.1.

To use this project:
- clone the repository
- run composer install (To install all the dependencies/packages used (https://getcomposer.org/))
- Create your .env.local and update the line for your database. (I used MySQL for this project)
- Edit the mailer DSN to use your mailer. (I used Mailtrap for this project. (www.mailtrap.io))

- run: symfony console d:d:c (To create the database) in your CLI (if you don't have the symfony CLI: https://symfony.com/download)
- run: symfony console d:d:m (To migrate the database) in your CLI (if you don't have the symfony CLI: https://symfony.com/download)
- run: symfony console d:f:l (To load the fixtures in to the database) in your CLI (if you don't have the symfony CLI: https://symfony.com/download)
- run: symfony serve -d (To launch the server) in your CLI (if you don't have the symfony CLI: https://symfony.com/download)
- run: symfony open:local (To open the server in your browser) in your CLI (if you don't have the symfony CLI: https://symfony.com/download)

The superAdmin is created with the Fixture Load. You can log in on the account with the password set in the BlogFixture.
The Admin is created with the Fixture Load as well. You can log in on the account with the password set in the BlogFixture.

You can create a new user on the register page. This will automatically give you the USER_ROLE.

This project is still a work in process.
