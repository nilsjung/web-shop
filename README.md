# web-shop
Web Application Security at the School of Applied Science in Kiel 

## Setup
Install XAMPP and clone this repository to `<path-to-xampp>/htdocs/` so that the `index.php` is in htdocs like `<path-to-xampp>/htdocs/index.php`.

Initialize the database by running `mysql -u root < path-to-xampp/htdocs/Application/Database/database.scheme.sql`

## Technical Requirements
* LAMPP Stack
  * mySQL (provided by xampp)
  * PHP > 7.2 (provided by xampp)

## Architecture

* The `Public` folder contains templating stuff and includes
* The `Application` folder contains the php classes 
* `index.php` is the entry point and routes the requests to the related controller

### MVC

#### Model
#### View and Templating
#### Controller

### Routing

---

## Guidlines by Krauss

**Project**
* Number of remaining items with verification that the 
  desired order quantity is also available and rejection of 
  an order quantity if the desired quantity exceeds the 
  existing quantity. 
* An article order influences the stock of articles 
* Shopping cart functionality (cookies) without login 
* Shopping cart view includes correction possibilities of the 
  existing order 
* Orders can be stored in a personalized manner and can be 
  called up for evaluation in the backend.
* Watch out for a good session management

**Check-Out Process**
Multi-step payment process (checkout) 
* Login or registration 
* Possibility of correction of existing personal data 
* Selection of various payment options 
* Confirmation display of personal, bank and article-related 
  data with possibility of printing after order activation 
## Grading/Project Requirements
* functionality and security matters / not UX
* 
