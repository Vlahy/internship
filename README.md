# Internship

API for tracking groups, mentors and interns.

# Project setup

```
1. Clone repository localy
2. Install dependencies via composer
3. Import intership.sql from Database(Faker) to your MySQL server
4. Run faker scripts which are in Database(Faker) folder
5. If You want, You can use Postman to test API
```

### POST and PATCH expect parameters in JSON format. Example:


### Intern and Mentor
```
{
    "fname": "John",
    "lname": "Doe",
    "email": "john.doe@gmail.com",
    "phone": "0123456789",
    "group_id": "1"
}
```
### Group
```
{
    "group_name": "Some Group"
}
```

# GET, PATCH, DELETE URL

```
Intern: http://localhost/intern/{id}
Mentor: http://localhost/mentor/{id}
Group: http://localhost/group/{id}
Group with paggination: http://localhost/gorup/{id}/?page={pageNumber}
```

# POST URL

```
Create intern: http://localhost/intern
Create mentor: http://localhost/mentor
Create group: http://localhost/group
```


