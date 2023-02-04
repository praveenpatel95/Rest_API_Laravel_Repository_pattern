# Packt Book Publication Backend Assessment

This library for handling apis of the given assessment.

## Requirement

- Minimum PHP ^8.1

## Installation

Clone the repository:

```
https://github.com/praveenpatel95/packt_backend_assessment.git

```

Then cd into the folder with this command:
```
cd packt_backend_assessment
```

Install composer with below command:
```
composer install
```

## Quick usage 

Copy .env.example file and rename with .env file.<br />
Or you can run this command
`cp .env.example .env`
<br />Just update the database credentials.

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_db_name
DB_USERNAME=my_user_name
DB_PASSWORD=my_password
```

Run storage command for store the images in folder:
```
php artisan storage:link
```

Now you need to run migration command for create all migrations tables:
```
php artisan migrate
```

If you want to dummy books data in the table (100 per command), 
<br >Run the below command:

```
php artisan db:seed
```


## Run Server

Now you can run your server with this command:
```
php artisan serve
```

## Rest API with example 

I attached the postman collection file in the repository for a better understanding and using the APIs.  Import the file in your postman and change the {{base_url}} in your postman environment.
You can find  all APIs endpoints there.


### For admin access
The REST API for the admin is described below.
- Admin can create, edit, delete, and get the books. Below are APIs for the admin access.


 ### Get All the books
 #### Request
`
GET /admin/books?page=2&perPage=10
`

$page=Page number, $perPage = Number of entry you want to show
<br>
It will return data as a JSON response with the paginataion.

#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": {
        "current_page": 2,
        "data":[
			{
                "id": 12,
                "title": "Queen in front of the hall.",
                "author": "Sapiente Autem",
                "genre": "SEO",
                "description": "Dignissimos quaerat quasi asperiores voluptas. ",
                "isbn": "4251974174",
                "image": "http://127.0.0.1:8000/storage/books/4251974174.jpg",
                "published": "1979-09-11",
                "publisher": "Packt"
            }
		],
		"next_page_url": "/admin/books?page=3",
        "path": "/admin/books",
        "per_page": 10,
        "prev_page_url": "/admin/books?page=1",
        "to": 20,
        "total": 100
	}
}	
```

### Create a new book
#### Request
`
POST /admin/books
`

Pass all the required parameters in the form body.
<br>Form Body:
```
array(
	'title' => 'Php advancedPhp advanced',
	'author' => 'praveen',
	'genre' => 'Est',
	'description' => 'in this book, all cover',
	'isbn' => '1234667',
	'image'=> new CURLFILE('/C:/Users/dekstop/logo.jpg'),
	'published' => '2022-02-22',
	'publisher' => 'Packt '
	)
```

#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": {
        "title": "sd",
        "author": "praveen",
        "genre": "Est",
        "description": "in this book, all cover",
        "isbn": "1234667",
        "published": "2022-02-22",
        "publisher": "Packt",
        "image": "http://127.0.0.1:8000/storage/books/1234667.png",
        "id": 101
    }
}
```

### Update the book detail
#### Request
`
POST /admin/books/$bookId?_method=put
`
Pass $bookId in parameter, andPass required fields in the form body.
<br>Form Body:
```
array(
	'title' => 'Php advancedPhp advanced',
	'author' => 'praveen',
	'genre' => 'Est',
	'description' => 'in this book, all cover',
	'isbn' => '1234667',
	'image'=> new CURLFILE('/C:/Users/dekstop/logo.jpg'),
	'published' => '2022-02-22',
	'publisher' => 'Packt '
	)
```

#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": {
        "title": "sd",
        "author": "praveen",
        "genre": "Est",
        "description": "in this book, all cover",
        "isbn": "1234667",
        "published": "2022-02-22",
        "publisher": "Packt",
        "image": "http://127.0.0.1:8000/storage/books/1234667.png",
        "id": 101
    }
}
```

### Get a book detail by id
#### Request
`
GET /admin/books/$bookId
`
Pass $bookId in parameter.

#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": {
        "id": 3,
        "title": "I've offended it again!' For.",
        "author": "Doloribus Optio",
        "genre": "Wordpress",
        "description": "Vel voluptatibus animi sed quibusdam. ",
        "isbn": "7403068130",
        "image": "http://127.0.0.1:8000/storage/books/7403068130.jpg",
        "published": "1952-12-12",
        "publisher": "Packt"
    }
}
```



### Delete a book
#### Request
`
DELETE /admin/books/$bookId
`

Pass $bookId in parameter.


#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": null
}
```

### For Customer 
The below APIs for the customer end

### Search books
For get all the books as per passed parameters and page, this api will give the books data.

#### Request
`
GET /search?q=Queen
`

q=is the search query parameter, and other paramaters are for filter:
<br>authors, genre, publisher. 
<br>You can pass multiple parameter. Example:<br>

`/search?q=Queen&page=1&perPage=10&authors=Doloribus Optio,Sapiente Autem&genre=Wordpress&publisher=Shim Publisher`


#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": {
        "current_page": 2,
        "data":[
			{
                "id": 12,
                "title": "Queen in front of the hall.",
                "author": "Sapiente Autem",
                "genre": "SEO",
                "description": "Dignissimos quaerat quasi asperiores voluptas. ",
                "isbn": "4251974174",
                "image": "http://127.0.0.1:8000/storage/books/4251974174.jpg",
                "published": "1979-09-11",
                "publisher": "Packt"
            }
		],
		"next_page_url": "/admin/books?page=3",
        "path": "/admin/books",
        "per_page": 10,
        "prev_page_url": "/admin/books?page=1",
        "to": 20,
        "total": 100
	}
}	
```

### Get filters parameters
#### Request
`
GET /filters
`

It will give you all authors, genre and publications with group by, so you can use this values as a filter in frontend:



#### Response
```javascript
{
    "error": false,
    "message": null,
    "data": {
        "authors": [
            "Doloribus Optio",
            "Sapiente Autem",
           
        ],
        "genre": [
            "CMS",
            "Ecommerce",
           
        ],
        "publisher": [
            "Packt",
        ]
    }
}
```


## License

[MIT](https://choosealicense.com/licenses/mit/)