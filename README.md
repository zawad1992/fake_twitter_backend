# FakeTwitter API Postman Collection

This repository contains the Postman collection for interacting with the FakeTwitter API. The FakeTwitter API allows you to perform various actions similar to a microblogging service, such as user registration, login, tweeting, and more.

## Getting Started

To get started with using this Postman collection, follow these steps:

### Prerequisites

- Postman: Ensure you have [Postman](https://www.postman.com/downloads/) installed on your system.
- FakeTwitter API: This collection is intended to be used with the FakeTwitter API. Make sure the API server is running and accessible.

### Importing the Collection

1. Download the Postman collection from [here](https://errorpoint.com/FakeTwitter.postman_collection.json).
2. Open Postman.
3. Click on `Import` in the top left corner.
4. Choose the downloaded JSON file or drag and drop it into Postman.

## Collection Overview

The collection includes various requests to interact with the FakeTwitter API. Here's an overview of the available requests:

- **Health Check**: Verifies if the API server is running.
- **Database Health**: Checks the MongoDB connection status.
- **User Registration**: Registers a new user.
- **User Login**: Authenticates a user and returns a token.
- **Token Refresh**: Refreshes the authentication token.
- **Post Tweet**: Allows a user to post a tweet.
- **View Tweets**: Retrieves a list of tweets.
- **View Tweet by ID**: Retrieves a specific tweet by its ID.

## Using the Collection

To use the collection:

1. Select a request from the collection.
2. Modify the request parameters as needed.
3. Send the request to interact with the FakeTwitter API.

## Environment Variables

The collection uses variables like `{{base_url}}`, `{{userId}}`, and `{{authToken}}`. Set these variables in your Postman environment for the collection to work correctly.

## Contributing

Contributions to this collection are welcome. Please read our contributing guidelines for more information.

## License

This Postman collection is released under the MIT License. See the [LICENSE](LICENSE) file for more details.
