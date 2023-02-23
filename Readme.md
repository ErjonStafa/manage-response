## Laravel Easy Response Handler Package

### Introduction

This is a personal project with the purpose of the use in my own projects to have an easy setup.
There is a combination of two parts.
 * Create response
 * Display it in toastr message

****

### Installation 

````
composer install erjon/manage-response
````
****

### Generate the response

````
use Erjon\ManageResponse\ManageResponse;

ManageResponse::viewSuccess('name.of.view', 'message title', 'message body');
ManageResponse::viewError('name.of.view', 'message title', 'message body');
ManageResponse::backSuccess('name.of.view', 'message title', 'message body');
ManageResponse::backError('name.of.view', 'message title', 'message body');
ManageResponse::viewExceptionError('name.of.view', 'message title', 'message body');
ManageResponse::backExceptionError('name.of.view', 'message title', 'message body');
````

***Please note that this work is still in progress and more improvement and methods will probably be on the way***
****

### Create layouts with toastr message

````
php artisan create:layout
php artisan create:layout --path=layouts/app
php artisan create:layout --toastr=layouts/includes/toastr
php artisan create:layout --path=layouts/app --toastr=layouts/includes/toastr
````

***The default directories are resources/views/layouts/app.blade.php and resources/views/layouts/includes/toastr.blade.php***

****


### In case you do not create templates

Use variables for error ````$errorTitle```` and ````$errorBody````
Use variable for success ````$successBody```` and ````$successTitle````
