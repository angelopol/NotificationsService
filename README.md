# General Notifications Service

## Overview

This application is a general notifications service built with Laravel. It provides an API to manage notifications, including creating, updating, deleting, and retrieving notifications. The notifications can be filtered by their status (pending, sent, failed) and by user email.

## API Structure

The API provides the following endpoints:

- `GET /notifications`: Retrieve all notifications.
- `GET /notifications/pending`: Retrieve all pending notifications.
- `GET /notifications/sent`: Retrieve all sent notifications.
- `GET /notifications/failed`: Retrieve all failed notifications.
- `POST /notifications`: Create a new notification.
- `GET /notifications/{id}`: Retrieve a specific notification by ID.
- `PATCH /notifications/{id}`: Update a specific notification by ID.
- `DELETE /notifications/{id}`: Delete a specific notification by ID.
- `GET /notifications/{email}`: Retrieve all notifications for a specific user by email.
- `GET /notifications/{email}/pending`: Retrieve all pending notifications for a specific user by email.
- `GET /notifications/{email}/sent`: Retrieve all sent notifications for a specific user by email.
- `GET /notifications/{email}/failed`: Retrieve all failed notifications for a specific user by email.

## Model Structure

The `Notification` model represents a notification in the database. The corresponding database table has the following structure:

- `id`: The primary key of the notification.
- `title`: The title of the notification (string, max 500 characters).
- `content`: The content of the notification (text).
- `email`: The email address of the recipient (string, max 500 characters).
- `action`: The action associated with the notification (string, max 500 characters, default: 'Go to mercly').
- `url`: The URL associated with the action (text, default: '/').
- `status`: The status of the notification (string, default: 'pending').
- `try`: The number of attempts to send the notification (integer, default: 0).
- `created_at`: The timestamp when the notification was created.
- `updated_at`: The timestamp when the notification was last updated.

## Examples of API Requests

### Retrieve All Notifications

```sh
curl -X GET http://localhost:8080/api/notifications
```

### Retrieve Pending Notifications

```sh
curl -X GET http://localhost:8080/api/notifications/pending
```

### Retrieve Sent Notifications

```sh
curl -X GET http://localhost:8080/api/notifications/sent
```

### Retrieve Failed Notifications

```sh
curl -X GET http://localhost:8080/api/notifications/failed
```

### Create a New Notification

```sh
curl -X POST http://localhost:8080/api/notifications \
    -H "Content-Type: application/json" \
    -d '{
        "title": "New Notification",
        "content": "This is the content of the notification.",
        "email": "user@example.com",
        "action": "View Notification",
        "url": "http://example.com/notification"
    }'
```

### Retrieve a Specific Notification by ID

```sh
curl -X GET http://localhost:8080/api/notifications/1
```

### Update a Specific Notification by ID

```sh
curl -X PATCH http://localhost:8080/api/notifications/1 \
    -H "Content-Type: application/json" \
    -d '{
        "title": "Updated Notification",
        "content": "This is the updated content of the notification."
    }'
```

### Delete a Specific Notification by ID

```sh
curl -X DELETE http://localhost:8080/api/notifications/1
```

### Retrieve Notifications for a Specific User by Email

```sh
curl -X GET http://localhost:8080/api/notifications/user@example.com
```

### Retrieve Pending Notifications for a Specific User by Email

```sh
curl -X GET http://localhost:8080/api/notifications/user@example.com/pending
```

### Retrieve Sent Notifications for a Specific User by Email

```sh
curl -X GET http://localhost:8080/api/notifications/user@example.com/sent
```

### Retrieve Failed Notifications for a Specific User by Email

```sh
curl -X GET http://localhost:8080/api/notifications/user@example.com/failed
```

## Other Important Information

### Notification Sending

The application uses Laravel's notification system to send notifications via email. The `GenericNotification` class is used to define the content and behavior of the notifications.

### Database Migrations

The database schema for the notifications is defined in the migration file `2025_03_08_160621_create_notifications_table.php`. This file contains the necessary code to create and drop the `notifications` table.

### Docker Setup

The application is containerized using Docker. The `docker-compose.yml` file defines the services required to run the application, including the Laravel application and a MySQL database. The `deploy/Dockerfile` file defines the build process for the Laravel application container.

### Running the Application

To run the application, use the following commands:

```sh
docker-compose up -d
```

This will start the Laravel application and the MySQL database in Docker containers.

### Environment Variables

The application uses environment variables to configure various settings. These variables are defined in the `.env` file. Make sure to set the appropriate values for your environment.