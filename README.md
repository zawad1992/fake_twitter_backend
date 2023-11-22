## Overview
This README document provides an overview and instructions for the FakeTwitter Postman collection. The collection is designed to interact with a mock Twitter-like API.

### Collection ID
- **ID**: `14cb3b22-992d-4f48-893f-543c822cc172`

### Schema
- **Schema Version**: `v2.1.0`
- **Schema URL**: [Postman Schema](https://schema.getpostman.com/json/collection/v2.1.0/collection.json)

## Endpoints
The collection consists of various endpoints to simulate a social media platform's functionality.

### Health Check
- **Endpoint**: `GET {{base_url}}/api/health`
- **Description**: Checks the health of the system. Returns `ok` if the system is functioning.

### Database Health Check
- **Endpoint**: `GET {{base_url}}/api/ping`
- **Description**: Checks the database connection. Returns `MongoDB is accessible!` if the connection is okay.

### User Registration
- **Endpoint**: `POST {{base_url}}/api/register`
- **Description**: Registers a new user. Generates a random name and email for registration.

### User Login
- **Endpoint**: `POST {{base_url}}/api/login`
- **Description**: Authenticates a user and provides a token for authorized requests.

### Token Refresh
- **Endpoint**: `POST {{base_url}}/api/refresh`
- **Description**: Refreshes the authentication token for a user.

### Tweet Operations
- **Create Tweet**: `POST {{base_url}}/api/tweets`
- **Retrieve Tweets**: `GET {{base_url}}/api/tweets`
- **Retrieve Tweets by User ID**: `GET {{base_url}}/api/tweets/{{userId}}`
- **Retrieve, Edit, Delete Tweet by ID**: 
  - `GET {{base_url}}/api/tweets/{{randomTweetId}}`
  - `PUT {{base_url}}/api/tweets/{{randomTweetId}}`
  - `DELETE {{base_url}}/api/tweets/{{randomTweetId}}`

### User Operations
- **Retrieve Users**: `GET {{base_url}}/api/users/`
- **Retrieve User by ID**: `GET {{base_url}}/api/users/{{userId}}`

### Follower Operations
- **Retrieve Followers**: `GET {{base_url}}/api/followers/`
- **Retrieve Followers by ID**: `GET {{base_url}}/api/followers/{{randomFollowerId}}`
- **Follow/Unfollow User**: 
  - `POST {{base_url}}/api/follow/{{randomFollowerId}}/1` (Follow)
  - `POST {{base_url}}/api/follow/{{randomFollowerId}}/0` (Unfollow)

### Like Operations
- **Retrieve Likes**: `GET {{base_url}}/api/likes`
- **Retrieve Likes by Tweet ID**: `GET {{base_url}}/api/likes/{{randomTweetId}}`
- **Like/Unlike Tweet**: 
  - `POST {{base_url}}/api/like/{{randomTweetId}}/1` (Like)
  - `POST {{base_url}}/api/like/{{randomTweetId}}/0` (Unlike)

## Usage Instructions
1. Import the collection JSON into Postman.
2. Set up the `base_url` environment variable to point to the API server.
3. Use the provided endpoints to interact with the API.

## Notes
- Some endpoints require authentication tokens. Ensure you're logged in to access these endpoints.
- The collection includes pre-request and test scripts for dynamic data generation and response validation.

---

*This README is generated based on the provided Postman collection JSON for the FakeTwitter API.*
