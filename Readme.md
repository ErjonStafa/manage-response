## Laravel Easy Response Handler Package

### Introduction

This is a personal project with the purpose of the use in my own projects to have an easy setup.
There is a combination of two parts.
 * Create response
 * Display it in toastr message

****

### Installation 

````
composer require erjon/manage-response
````
****

### Generate the response

````
use Erjon\ManageResponse\ManageResponse;

return ManageResponse::viewSuccess('name.of.view', 'message title', 'message body');
return ManageResponse::viewError('name.of.view', 'message title', 'message body');
return ManageResponse::backSuccess('name.of.view', 'message title', 'message body');
return ManageResponse::backError('name.of.view', 'message title', 'message body');
return ManageResponse::viewExceptionError('name.of.view', 'message title', 'message body');
return ManageResponse::backExceptionError('name.of.view', 'message title', 'message body');
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


### Managing validation request errors

**Inside your FormRequest Class override the failedValidation method**

````
protected function failedValidation(Validator $validator)
{
    ManageResponse::createValidationErrorSession($title = 'Given data was invalid!', $validator->failed());
    parent::failedValidation($validator);
}
````

**By default the message displayed is the one below**
````
Singular: There was 1 error.
Plural: There were 5 errors.
````

You can publish the language files to change this message

````
php artisan vendor:publish --tag=manage-response
````

***Found in lang/vendor/manage-response/en/manage-response.php***

### In case you do not create templates

Use variables for error ````$error=true```` ````$errorTitle```` , ````$errorBody````
<br>
Use variable for success ````$success=false```` ````$successBody```` , ````$successTitle````
<hr>

For the ````ManageResponse::createValidationErrorSession()```` check the code below to get a reference of how the things work

````
@php
    if (Session::has('error')) {
            //This variable is always true
            $error = Session::get('error');
            Session::forget('error');
    }

    if (Session::has('errorBody')) {
            $errorBody = Session::get('errorBody');
            Session::forget('errorBody');
    }

    if (Session::has('errorTitle')) {
            $errorTitle = Session::get('errorTitle');
            Session::forget('errorTitle');
    }
@endphp
````

***Note!*** **This code is in the toastr.blade.php file**
