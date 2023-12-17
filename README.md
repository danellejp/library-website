# library-website
Book reservation website using PHP, MySQL database, HTML and CSS. This website allows users to search for and reserve library books. They are also able to register, login, view reserved books and log out. 

## Part 1: PHP pages used with description:
### Login: 
This is the first page the user sees when they access the website. It logs the user in if their username and password are correct. The user has to be registered in order to successfully login, if not there is a link on this login page that takes them to the register page. If the user’s password or username is incorrect, an error message will be displayed. When the user has logged in successfully, a session is created, and this lets the user access the different functions in the site e.g. Reserve a Book or View Reservations.
### Signup:
This page can only be accessed on the login page. It allows a user to create an account if they are not already registered. The user must fill in a number of fields correctly in order to successfully create an account. If the fields are blank or not filled in correctly, an error message is displayed, and the form is displayed to the user again so they can correctly fill it out. If the user successfully registers, they are taken to the login page where they can now access the website by logging in with their new username and password. 
### Connection:
This file is not displayed in the browser. It contains the login information (name and password) and server name to access the PHPAdmin SQL Server. This server is used by every page on the website. 
### Index:
This is the first page that the user sees when they successfully login. It has a navbar that allows the user to access different functions on the website such as “Search for a Book”, “View My Reserved Books” and “Remove”, which is a link on the “View My Reserved Books” page that allows the user to remove a reservation. This index page also contains other general information about the library such as the opening hours and other news. It is the welcome page to the user and personally greets them by their username. 
### Search:
The search page allows a user to search for a book via 3 different ways. The user can search for a book by typing in an author, a book title or by choosing a category from the drop-down menu displayed. There is a book table and a category table in the database where the information that the user chooses to search by, comes from. When the user searches by any of these three options, a query is sent to the database. This query looks for the result that exactly matches the user’s input for a category. If the user input’s a search for a book title or an author, the query will return either an exact match, if it is in the database, or a match that is similar to the user’s input. The result is then printed in the form of a table and provides the book title, author, edition, year and a link to reserve the book, if it is available. If the book is not available to reserve, then the user is not able to reserve it (there is no link and “Already Reserved” is displayed). If there are no results to the user’s search, then “0 results” is displayed.
### Logout:
This php file terminates the login session for the user when clicked on from any page on the navigation bar. When the “Log out” button is clicked on from the navigation bar, it will log the user out i.e. terminate the session and take the user back to the login page. 
### View:
The view page will display all the books that the user has reserved. It displays the table showing the book title, author, reservation date and an option to end the reservation. This view page queries the database based on the username and returns all the results associated with that particular username. If there is none, it displays “0 results”.
### Remove:
This page can only be accessed through a link on the “View My Reserved Books” page. When the table of reserved books by the user is displayed, a link that says “Remove Reservation” is shows next to each book. It confirms with the user if they want to remove the book by displaying the name of the book, the author and a confirmation button. It then removes the reservation from the reserved table in the database. It does this by sending an SQL argument that changes the reserved column in the book table to ‘N’ which means that the book is available to reserve again. 
### Reserve:
This page can only be accessed when the user searches for a book (by name, author or category) on the “Search for a Book” page. When the user searches for a book, a table is displayed with book title, author, year, edition and availability. Under the availability column in the table displayed, it will say whether the book is available to reserve or not. If it is available to reserve, there will be a link called “Reserve” which takes the user to the reserve page. The reserve page confirms with the user if they want to reserve that specific book and there is a confirm button and a cancel button. If the user confirms that they want to reserve the book, it reserves the book and displays a confirmation message to the user. If the user reserves a book, two SQL arguments are sent to the database. One changes the reserve value in the book table to ‘Y’ and the other adds the reservation in the reserved table. 

## Part 2: Screenshots of each page in website

### Login:
 ![login page](https://github.com/danellejp/library-website/assets/124165006/c09cf771-288c-4097-a351-1eba0abb6141)

### Sign Up/Register:
![sign up page](https://github.com/danellejp/library-website/assets/124165006/f89b15e7-44b8-4b0a-b518-4e989536e538)

### Welcome/Index:
![index page](https://github.com/danellejp/library-website/assets/124165006/798a5e23-b0d6-47f5-b87c-472f41ea206f)

### Search:
![search page](https://github.com/danellejp/library-website/assets/124165006/edcbb6ba-a575-4bca-9ce6-1bed6311f566)

### Reserve:
![reserve page 1](https://github.com/danellejp/library-website/assets/124165006/0b5cd718-b636-41a1-a8e3-423d9d9af849)
![reserve page 2](https://github.com/danellejp/library-website/assets/124165006/58fd0267-c93d-43f4-9992-5ea6e317fec4)

### View Reservations:
![view reservations page](https://github.com/danellejp/library-website/assets/124165006/90604c6c-37ca-4099-99de-fedb3c646db5)

### Remove Reservation:
![remove reservations page 1](https://github.com/danellejp/library-website/assets/124165006/bf525565-ea6f-4e38-b77b-4886ac4f409e)
![remove reservations page 2](https://github.com/danellejp/library-website/assets/124165006/10ef6012-d9a2-4219-bd97-242bf683928e)
