# Laravel Package Boilerplate
As this is something I often repeat, I just created a repo for it.

## How to use?
Install the repository with composer as a new project

```bash
composer create-project --prefer-dist hpolthof/laravel-package my-package
```

This will build the project, now enter the project directory and run:

```bash
php install.php
```

You will now be prompted to set the name and namespace of the package. 
Afterwards the package will be configured for use.

## Publish your package
To publish your package you should publish it into a Github repo and add it to
[packagist](https://packagist.org/). 

## Disclaimer
This package is used for internal development, but published for public use. 
Obviously this software comes *as is*, and there are no warranties or whatsoever.

If you like the package it is always appreciated if you drop a message of gratitude! ;-)

The package was build by: Paul Olthof