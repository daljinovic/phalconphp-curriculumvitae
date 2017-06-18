# phalconphp-curriculumvitae
CV creation and search platform oriented towards students and employers.

Application based on PhalconPHP 3.1.2 ([https://phalconphp.com/en/](https://phalconphp.com/en/)) and PHP 5.6.


## Installation

PhalconPHP is a C-extension so its setup differs from other frameworks. Please follow one of the guides depending on your environment:

[https://docs.phalconphp.com/en/latest/reference/install.html](https://docs.phalconphp.com/en/latest/reference/install.html)

### Database setup

Create empty database, call it *phalconcv* and import schema from phalconcv.sql. Set your database credentials in index.php.

There is some test data provided, including user accounts with passwords set to "123".


### Application structure

Move the files into a specific folder called PhalconCV. Place the folder at the server root and access like: ```localhost/PhalconCV/```

In case you change the folder name, you must change the BaseURI inside index.php file. Phalcon will prefix any route with specified URI, in this case ```/PhalconCV/```. In case of files being in server root, URI would be just a slash ```/```.

    - app/ - Application code
      -- compiled/ - Rendered view files
      -- plugins/ - Classes that extend Plugins class
      -- routes/ - Route groups divided into separate files
      -- models/ - Model classes
      -- controllers/ - Controller classes
      -- views/ - .volt files for view rendering
          --- templates/ - Base layouts; views extend these
          --- partials/ - Reusable view code for including in other views
          --- index/ - Views for Index Controller
          --- student/ - Views for Student Controller
          --- employer/ - Views for Employer Controller

    - public/
      -- css/
      -- js/
      -- .htaccess - Directs to index.php
      -- index.php - Main entrypoint and configuration

    - .htaccess - Directs to public/ folder



## Built With

* [PhalconPHP](https://phalconphp.com/en/) - PHP framework


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Conclusion

This application is far from finished! Some stuff can be done better but the main goal is to explore Phalcon's functionalities and use-cases as much as I can.

#### To Do:

* API location search and store in database
* Image upload
* Generate PDF version of CV
* Ajax search of CVs

