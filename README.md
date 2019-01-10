# MVC pattern

A simple MVC pattern in PHP without rooter.
If you want to create a new website in PHP using the MVC architecture, just copy this repository!

## Getting Started

You obviously need first to copy this repository.

### Controllers

The controllers must be in the root of the repository because there's no rooter in this pattern (because I don't like this).
You need to add this line at the beginning of all your controllers to use the global variables:
```
require_once("include/conf.php");
```

### Database

#### Connection

To connect this pattern to your database, enter the server path (localhost for example), the name, the user and the password in the defines of the "conf.php" file in the "include" folder.

#### Use the DAO

The proper way to proceed is to create a DAO for each entity. For example, you can create an EntityDAO object that's extended of the DAO object of the pattern. Then, you just have to use the functions of the DAO object. This example is available in the "model" folder to help you understand.
