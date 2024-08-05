# Introduction

This is a complex login management system that mainly uses the PHP language. In this project I focused on the backend and the security of the system also things like design pattern e.g repository pattern and dependency injection. The frontend is very simple and basic with Bootstrap.

For reference I used the following tutorial: [Web Login System Using PHP and MySQL](https://www.youtube.com/watch?v=Rw5HB2IwNAA&pp=ygUecHJvZ3JhbWVyIHRhbWFuIG5vdyBwaHAgbG9naW4g)

# Lessons learned

1. **Why Not Pure MVC Architecture**
   - The logic can become overly complex on the controller side, centralizing the application's logic. The controller takes requests from users, retrieves data, and forwards the request to the service layer.

2. **Service Layer**
   - This layer centralizes business logic (e.g., registration processes). It handles the core functionality of the application, separating business logic from controllers and repositories.

3. **Middleware**
   - Middleware components handle cross-cutting concerns such as authentication, logging, and request validation. They process requests before they reach the controllers and can modify responses before sending them back to the client.

4. **Repository Layer**
   - This layer facilitates communication between services and the database. It contains all database interaction logic, typically with one repository file per database table.

5. **Model Layer**
   - To assist the controller, I created two types of models:
     - **DTO (Data Transfer Object)**: Wraps all parameters for specific actions into a single class, making the request and response handling more manageable.
     - **Domain Model**: Represents database tables and is used in the repository layer for database interactions.

6. **Maintaining Code with the Model Layer**
   - The Model layer enhances code maintainability. For example, when the number of form fields changes, you only need to update the attributes in the Model layer instead of modifying every function parameter and related tests. This approach applies to both request and response handling.

7. **Testing Considerations**
   - When implementing tests, consider entity relationships and constraints like `ON DELETE` and `ON UPDATE` actions. Properly addressing these relationships ensures the integrity and consistency of the database.
