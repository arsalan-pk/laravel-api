# The Right Software Task

## Description

This project implements a Laravel API for managing feedback. It includes endpoints for user authentication, feedback management, and searching feedback.

## Task

The task includes implementing the following endpoints:

- User Login: POST /user-login
- User Logout: POST /user-logout
- Search Feedback: GET /search-feedback
- Index Feedback: GET /index-feedback
- Store Feedback: POST /store-feedback
- Show Feedback: GET /show-feedback/{id}
- Update Feedback: PUT /update-feedback/{id}
- Delete Feedback: DELETE /delete-feedback/{id}

## Implementation

### Feedback Controller

The feedback controller handles CRUD operations for feedback:

- `index(Request $request)`: Retrieves paginated feedback data.
- `search(Request $request)`: Searches feedback based on a query parameter.
- `store(StoreFeedbackRequest $request)`: Stores a new feedback entry.
- `show(string $id)`: Retrieves details of a specific feedback entry.
- `update(UpdateFeedbackRequest $request, string $id)`: Updates an existing feedback entry.
- `destroy(string $id)`: Deletes a feedback entry.

### Auth Controller

The auth controller handles user authentication:

- `login(LoginRequest $request)`: Authenticates a user and generates an API token.
- `logout(Request $request)`: Logs out a user by revoking their API token.

### ApiResponse Class

The `ApiResponse` class provides standardized JSON responses:

- `withData($data = [], string $message = 'Request Successfully Proceeded', int $statusCode = 200)`: Returns a JSON response with data.
- `withSuccess(string $message = 'Request Proceeded', int $statusCode = 200)`: Returns a JSON response indicating success message.
- `withError($error = '', string $message = 'Request Proceeded', int $statusCode = 400)`: Returns a JSON response indicating an error message.

### ApiValidation Class

The `ApiValidation` class handles validation errors and provides standardized responses for invalid requests:

- `invalid(array $errors = [], string $message = 'Submitted Request is Not Valid', int $statusCode = 422)`: Throws an HTTP response exception with validation errors.
- `invalidCredentials(string $errors = '', string $message = 'Submitted Request is Not Valid', int $statusCode = 422)`: Returns a JSON response with invalid credentials error.
- `invalidApi(string $errors = '', string $message = 'Submitted Request is Not Valid', int $statusCode = 422)`: Returns a JSON response with invalid API request error.

## validation

The - `HTTP Request Validation ` is handel form laravel request classes 

## Exception Handling

The `render` method in the exception handler class (`App\Exceptions\Handler`) is responsible for converting exceptions into HTTP responses. In this project, the `render` method is customized to provide JSON responses for API routes:

- **Method Not Allowed**: Returns a JSON response with status code 405 if the HTTP method is not allowed for the requested route.
- **API Not Found**: Returns a JSON response with status code 404 if the requested API route is not found.
- **Unauthorized**: Returns a JSON response with status code 401 if the request is unauthorized.
- **Route Not Found**: Returns a JSON response with status code 404 if the requested route is not found.
- **Unauthenticated**: Returns a JSON response with status code 401 if the user is not authenticated.
- **Forbidden Unauthorized**: Returns a JSON response with status code 403 if the user is not authorized to access the resource.

This custom exception handling ensures consistent and meaningful responses for API requests only.
