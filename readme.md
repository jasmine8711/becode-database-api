# Simple API for a note app in PHP

##the API
I use ARC( Advanced Rest Client) application to test if the api works.
Notes are accessed by TITLE for creation, showing, editing and deleting
Updating notes.
Use a HTTP(S) GET to retreive data, POST request for adding, POST requests for updating, DELETE requests for deleting .
API retuen json data.

### Create note

http://localhost/notes/create.php?title=notetitle
Title of note is using GET method, and the content of note is using POST method.

### Read note

http://localhost/notes/read.php?title=notetitle
http://localhost/notes/read.php?id=noteid
I give two ways to search and read the note you creat, one is using title ,and the other is using id.
The task is that using title to search for notes, but the reason i create a function that can also search note by id is that it will be a lot easier if later i need to update the note.

###Delete note
http://localhost/notes/delete.php?title=notetitle

###Update note
http://localhost/notes/update.php?title=notetitle

##What do i learn from this assignment?

1. Database,mysql. i am using Mysqlworkbench to creat my database.
1. SQL CRUD.
1. Connect database.Using PDO.
1. Prepared statment.
1. PHP OOP.
1. PHP class.
1. Comment others's code on github.It is a part of the task, we need to comment each other's code on github.
