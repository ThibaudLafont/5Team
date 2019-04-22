# Coding in object
This app will simulate a company containing several offices. An office
can be for developers or for commercials.   
In order to know if an office is full, each Office object implements a `freeSpaceRate` 
method which will return an int. If this int is negative the office still can hire new workers, the office
is full when `Office::freeSpaceRate` is 0.    

### Run the app
Run a php server and visit the `index.php`. For example : 
    
    cd /path/to/this/repository
    php -S localhost:4444

Then visit `http://localhost:4444` with your browser.

At each hiring loop app will display Company freeSpaceRate, number of developers, number of 
commercials and the state of each office (office name, number of workers, freeSpaceRate). Code as been
documented, see classes for more informations.

### Architecture

    app       --- Contain Company and Office classes
    core      --- Contain unspecialized code (Autoloader, Hydrate trait)
    data      --- In order to clean index.php, Offices datasets has been stored in separate files
    index.php --- Setup the application, then launch Company::hire
    

