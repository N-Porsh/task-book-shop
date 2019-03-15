Allocated time: approx. 8 hours
### Task description
##### Scope:
You are expected to develop a number of restful endpoints which consume and produce JSON for an example online book shop.
The application should at minimum support the following primary functions:
* A user can register/un-register to the platform.
* A user can access their personal data and update their details (no authentication required).
* A user can list all books currently available in the store.
* A user can purchase books from the store.
* A user can access his purchase history.

##### Instructions:
* Your app should follow clear Domain Driven Design patterns and conventions. Design the app in a way that it is possible to easily eject
and scale domains;
* You can use any PHP framework or library (currently we are using the Laravel framework, or the Lumen micro-framework).
* You should use a MySQL database.
* You should include PSR-3 logging for errors, exceptions, and user/system operations.
* Unit Testing – we would appreciate to see some sort of code coverage. Test what you think is critical.
* Include a README file explaining decisions you made along the way, what you focused on and why.
---
### Installation:
##### Vagrant :
1. install [VM VirtualBox v5.1.14](https://www.virtualbox.org/wiki/Download_Old_Builds) or newer
2. install [Vagrant](https://www.vagrantup.com/downloads.html) for your OS
3. check `VagrantFile` for some configuration if needed (default host port is: **80**)
4. open terminal, navigate to application folder and type: **vagrant up**
5. wait, it should download all the dependencies, you will see the message when it finishes.
6. You are ready to test the app.

---
# Documentation:

Swagger schemas used as a documentation and validation resource.

<table>
    <tr>
        <th>METHOD</th>
        <th>Description</th>
        <th>URL</th>
        <th>URL params</th>
        <th>Data params</th>
        <th>Request example</th>
    </tr>
    <tr>
        <td>GET</td>
        <td>Get all products</td>
        <td>/api/v1/store/products</td>
        <td>-</td>
        <td>-</td>
        <td></td>
    </tr>
	<tr>
		<td>POST</td>
		<td>Add new product</td>
		<td>/api/v1/store/products</td>
		<td>-</td>
		<td>name(required)=String
		price(required)=decimal(2 signs after dot)</td>
		<td>{
              "name": "book1",
              "price": 50,
              "description": "Some text"
            }</td>
	</tr>
    <tr>
        <td>GET</td>
        <td>Get all users</td>
        <td>/api/v1/users</td>
        <td>-</td>
        <td>-</td>
        <td></td>
    </tr>
    <tr>
        <td>GET</td>
        <td>Get user by {user_id}</td>
        <td>/api/v1/users/{user_id}</td>
        <td>user_id=number</td>
        <td>-</td>
        <td>-</td>
    </tr>    
	<tr>
		<td>PUT</td>
		<td>Update user information</td>
		<td>/api/v1/users/{user_id}</td>
		<td>user_id=number</td>
		<td>username=String(100c)
		password=String(255c)
		email=email type(255c)
		name=String(255c)
		surname=String(255c)
		birthdate=String(format: YYYY-MM-DD)</td>
		<td>{
              "username": "jmer",
              "password": "1231231",
              "email": "new_emal@poke.com",
              "name": "Jerry",
              "surname": "Mick",
              "birth_date": "1975-09-20"
            }</td>
	</tr>
	<tr>
		<td>POST</td>
		<td>Create new user</td>
		<td>/api/v1/users</td>
		<td>-</td>
		<td>username=String(100c)
		password=String(255c)
		email=email type(255c)
		name=String(255c)
		surname=String(255c)
		birthdate=String(format: YYYY-MM-DD)</td>
		<td>{
              "username": "jmer",
              "password": "1231231",
              "email": "new_emal@poke.com",
              "name": "Jerry",
              "surname": "Mick",
              "birth_date": "1975-09-20"
            }</td>
	</tr>
    <tr>
        <td>DELETE</td>
        <td>Delete user by {user_id}</td>
        <td>/api/v1/users/{user_id}</td>
        <td>user_id=number</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>POST</td>
        <td>Buy product</td>
        <td>/api/v1/users/{user_id}/buy</td>
        <td>user_id=number</td>
        <td>products=Array or integers(product IDs)</td>
        <td>{
              "products": [11, 2, 11]
            }
    </td>
    <tr>
        <td>GET</td>
        <td>Get all transactions</td>
        <td>/api/v1/transactions</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>Get transaction by {transaction_id}</td>
        <td>/api/v1/transactions/{transaction_id}</td>
        <td>transaction_id=number</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td>GET</td>
        <td>Get transaction by {user_id}</td>
        <td>/api/v1/transactions/user/{user_id}</td>
        <td>user_id=number</td>
        <td>-</td>
        <td>-</td>
    </tr>        
    </tr>
</table>

Validation error example: 

POST http://localhost:80/api/v1/store/products

request body:

```json
{
  "non_existing": "notebook"
}
```
Status code: *400*

Response example:
```json
{
  "status": "validation_failed",
  "errors": [
    {
      "property": "name",
      "message": "The property name is required",
      "constraint": "required"
    },
    {
      "property": "price",
      "message": "The property price is required",
      "constraint": "required"
    },
    {
      "property": "",
      "message": "The property non_existing is not defined and the definition does not allow additional properties",
      "constraint": "additionalProp"
    }
  ]
}
```

#### Running Unit test:
1. In terminal navigate to source folder and type: `vagrant ssh`
2. `cd /vagrant/service/api-task`
3. `composer test`