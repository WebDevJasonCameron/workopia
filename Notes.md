# My Notes

## 2025 03 14

NOTE. running in build, you want to use `npm run build`

===

Did a lot for map box, and you should look at the code and notes from the instructor later when you want to try using it in other applications. However, we are also using mailtrap and this requires you to make a mail object with the following

```
php artisan make:mail JobApplied
```

---

## 2025 03 13

To fix the blipping motal from showing use `[x-cloak] { display:none !important; }` in the public/css/style.css file. Then add `x-cloak` wherever you are using the `x-show...` flag.

---

## 2025 03 10

Paginations is simple. All you need to do on the page is change all() to panginate() in the handler. Then you need nav buttons... but that is easy too. You just put {{ $jobs->links() }} or the equiv on that same view page. It works but it is ugly. You will need to create a vender style with:

```
php artisan vendor:publish --tag=laravel-pagination
```

---

## 2025 03 08

We need to let users add a profile picture to their profile. This will require making a database migrations. This uses the following artisan command to create a file that we can add methods to perform this function:

```
php artisan make:migration add_avatar_to_users_table --table=users
```

After you update up/down methods within the migration cmmand file that was created in the databas directory, you can run it with:

```
php artisan migrate
```

---

## 2025 03 06

Making a policy to check if a user can edit or delete, you use the following... (note the model flag points to which table in the db we are focussing on)

```
php artisan make:policy JobPolicy --model=job
```

But then you need to register it with a provider using...

```
php artisan make:provider AuthServiceProvider
```

This can be very confusing so check out what was done in the app/Providers/AuthServiceProvider.php file. Note, we removed an imported line with a more definded ServiceProvider line at the top (extends original provider line)

---

## 2025 02 24

A really neet line to see file data you're uploading can be found with this do and die function:

```
dd($request->file('company_logo'));
```

Setting up a place to locally store the image files:

```
php artisan storage:link
```

---

## 2025 02 22

I wanted to reset my db data cause of all the crazy entries I put into it. I knew this should be easy but I didn't realize how easy it is with the seeder.

```
php artisan db:seed
```

---

## 2025 02 21

Alpine.js with Laravel. Go to the website: alpinejs.dev

---

## 2025 02 20

When you make a component, it places it creates a controller and a view. If you want to organize the views by making a sub dir you will need to move that created view into the created sub dir. You will also need to update the controller to return the propper path to that view by including the sub dir in the return path. For example, `return view 'component.inputs.input_view.php'

---

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

### Making a Seeder Based on actual data

If you want to make a seeder baased on actual accumulated data, ensure you place the data in a database/seeder/data directory (you will need to create this). Then past the data in a php file. See the database/seeder/data job_listings.php for an example. Then create a seeder...

```
php artisan make:seeder JobSeeder
```

Next, review what was done in the database/seeders/JobSeeder.php file to build out your own seeder. Note, you will need to include a couple of "use" statements that weren't auto generated.

_Note_ you can use '&' to pass a variable as a reference. See below as an example...

```
foreach($jobListings as &$listing) {}
```

Once your done with the "JobSeeder" (or what every seeder you created), include the changes in the Database Seeder. This manages all the seeders (deletes data, and runs seeders in the order you need, like users first then job_listings, because job_listings requires users first). Then run the...

```
php artisan db:seeder
```

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
