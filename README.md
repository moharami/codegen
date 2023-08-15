# Laravel Prompt API Generator

This project provides a fast and streamlined way to create a RESTful API using Laravel Prompt. By answering a few questions, you can generate all the necessary code to set up your API.

## Getting Started
To get started with the Laravel Prompt API Generator, please follow these steps:

#### Install the necessary dependencies:
composer require this package

```bash
composer require moharami/codegen --dev
```

### Set your database variable
open .env file and put your database variable that your program can connect to database correctly.

### Run the following command:

```bash
php artisan make:code
```
Answer the prompted questions to configure your API. These questions will include details about routes, controllers, models, and database migration.

Once you have answered all the questions, the Laravel Prompt API Generator will generate all the necessary code files and configurations for your RESTful API.

Finally, run the following command to start your API server:

```bash
php artisan serve
```

Your RESTful API is now up and running! You can access it by visiting http://localhost:8000 in your browser.

### What files does it create?

the list of files that this command creates is : 

1. Model
8. Migration (add fields you write in propmt)
2. Controller
3. BaseController
4. Request(save and update) - for validation base on your input
5. Reource
6. Factory
7. Seeder
6. Route ( add a new route )
7. Exception

### Contributing
Contributions are welcome! If you encounter any issues or have any suggestions for the Laravel Prompt API Generator, feel free to open an issue or submit a pull request.

### License
This project is licensed under the MIT License - see the LICENSE file for details.
