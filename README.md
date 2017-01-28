# projet
depot github projet

# Flash module

Location : Model

Use in order to display message from a page to another (like error in form, or success of request)

Call : require "model/flash.php" (Always call it before template/_header.php)

How to use :

In your process write $_SESSION['flash'] = [type of message, content of your message]

type of message : (string) danger, success, info, warning (refer to bootstrap alert in js section)

content of your message : (string) talk for itself

After this put a header location to the file you want to display

/!\ Do this even if this point to the current page

Please edit the doc if you change the flash module.
