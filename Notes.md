# My Notes

## 2025 02 19

Using Factories. This is found in the database / factories. You can use tinker to use the Faker generator. Below is an exampl... (The following creates one user)

```
\App\Models\User::factory()->create();
```

To create multiple users...

```
\App\Models\User::factory()->count(10)->create();
```

Since one of the columns shows a possible email verification, you can make a user that does not have a verified email with the following...

```
\App\Models\User::factory()->unverified()->create()
```

We can also create a factory to fill out our job_listings table. Create the factory with...

```
php artisan make:factory JobFactory
```

\*\*See database/factories/JobFactory.php on how to fill out the php (good stuff!)

Then run the new factory in tinker

```
php artisan tinkder

\App\Models\Job::factory()->create()
```

Creating a random seeder for the user table

```
php artisan make:seeder RandomUserSeeder
```

Then fill out the database/seeers/RandomUserSeeder.php and run it with...

```
php artisan db:seed     # (this would run the db seeder)
php artisan db:seed --class=RandomUserSeeder

```

_By the way, the password is hashed, but it is set to be "password" for all users_

---

## 2025 02 18

To update a table using artisan (create a new migration)

```
php artisan make:migration add_fields_to_job_listings_table --table=job_listings
```

---

## 2025 02 16

Using Tinker in the CLI. Tinkder is the ORM providing the CRUD features

```
php artisan tinker

App\MOdels\Job::all()

Schema::getColumnListing('job_listings')


```

You can use 'q' to quit a function...

Make a variable with of the class with the following (so you don't need to keep writing it out)

```
$job = App\Models\Job::class

```

Now you can use the following...

```
$job::all()
```

Now you can create a record in the db table

```
$job::create(['title' => 'Job One', 'description' => 'This is job one'])

```

Additional functions with this (using the variable we assigned to the table...)

```
$job::all()
$job::find(1)
$job::find(1)->update(['title' => 'Updated Job '])
$job::find(4)->delete()

```

---

## 2025 02 15

### 1030

Create a Model with artisan

```
php artisan make:model Job
```

Interestingly, I needed to add `use Illuminate\Database\Eloquent\Factories\HasFactory;` and `use HasFactory; ` in the model that was created...

### 1000

Creating a migrations with artisan

```
php artisan make:migration create_job_listings_table

```

### 0900

I got a error telling me:

```
Notice: file_put_contents(): Write of 56 bytes failed with errno=32 Broken pipe in /Users/jasoncameron/Herd/workopia/vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php on line 21
```

As such, I commented the line 21 and I don't have the error anymore. This might be a problem later though, so I'm keeping this as a note!

### Better fix

I asked GPT and restarting the server was a better fix: php artisan serve

## =======================================================================

## Notes Prior to 2025 02 14

These notes were taken and put in the original readme. However, that was getting to unorganized and I placed them here.

## My notes

Createing a controller with artisan...

```
php artisan make:controller NameOfController
```

Or... Even Better!

```
php artisan make:controller JobController --resource
```

To make components (such as the nav bar)

```
php artisan make:component Header
```

### Installing Tailwind CSS

https://tailwindcss.com/docs/installation/using-vite

```
npm i -D tailwindcss postcss autoprefixer
npm i
```

Generate a config file

```
npx tailwindcss init -p
```

Check to see if the content is added...

```
content: [
  "./resources/**/*.blade.php",
  "./resources/**/*.js",
  "./resources/**/*.vue",
]
```

Check to see if your resources/css/app.css file has the following:

```
@tailwind base;
@tailwind components;
@tailwind utilities;
```

Finally, include the following in your resources/views/layout.blade.php file (could be in the components sub directory)... and (place it abouve the head's title)

```
  @vite('resources/css/app.css')
```

### Run the server (for auto updates):

```
npm run dev
```

### Want Font Awesome?

-   Go to cndjs.com and search font-awesome
-   Copy the link tag... should like below

```
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
```

-   paste into the resources/views/laoyout.blade.php above the @vite (previously added)... (layout could be found in the sub directory (components))

### Making in a nav link or button link with Artisan

```1
php artisan makd:component NavLink
```

### Postgres

using Postgres 14... might (confirmed) be a difference between the app and brew install... using brew,

Start the server

```
brew services start postgresql@14
```

Check the server activity

```
brew services list
```

Access in terminal

```
psql postgres
```

Check dbs

```
\list
```

Get users

```
\du
```

Quit

```
\q
```

Go to pgadmin.org to get the latest version...
