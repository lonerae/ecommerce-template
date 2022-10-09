# Ecommerce-template

!WORK IN PROGRESS!

## About

A highly customisable front-end and back-end template for your ecommerce site.

## Instructions

- Check `databases` to see how to setup the databases for your products (or customise it to fit your liking).
  - MySQL commands to create the tables coming soon!
- On `screens/helper/headers.php` change `function connect($db)` to match your database.
- Put all files inside the public html folder on your server's control panel, after changing the placeholder values of menus etc.

  ### Email (`confirmation.php`)

  To set up the automatic emails on cart checkout, visit [Sendgrid](https://sendgrid.com/) and create an account!
  - Detailed instructions on the whole process coming soon!  
  
## Known Issues

- If `header('Location: destination.php');` doesn't seem to work, try `echo '<script> window.location.href = "destination.php"; </script>';` instead.

