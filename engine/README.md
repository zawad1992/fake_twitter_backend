# FakeTwitter API Postman Collection

This repository contains the Postman collection for interacting with the FakeTwitter API. The FakeTwitter API simulates a microblogging service, allowing for actions such as user registration, posting tweets, liking and unliking tweets, following and unfollowing users, and more.

## Getting Started

To utilize this Postman collection, follow these steps:

### Prerequisites

- **Postman**: Install [Postman](https://www.postman.com/downloads/) on your system.
- **FakeTwitter API**: Ensure the FakeTwitter API server is running and accessible.

### Importing the Collection

1. Download the Postman collection from [here](https://errorpoint.com/FakeTwitter.postman_collection.json).
2. Open Postman.
3. Click `Import` in the top left corner.
4. Select or drag and drop the downloaded JSON file into Postman.

## Collection Overview

The collection includes various requests to interact with the FakeTwitter API:

- **Health Check**: Verify if the API server is operational.
- **Database Health**: Check the MongoDB connection status.
- **User Registration**: Register new users.
- **User Login**: Authenticate users and return tokens.
- **Token Refresh**: Refresh authentication tokens.
- **Post Tweet**: Allow users to post tweets.
- **View Tweets**: Retrieve a list of tweets.
- **View Tweet by ID**: Fetch a specific tweet using its ID.
- **Like Tweet**: Like a tweet as a user.
- **Unlike Tweet**: Remove a like from a tweet.
- **Follow User**: Follow another user's account.
- **Unfollow User**: Unfollow a user.

## Using the Collection

To use the collection:

1. Select a request.
2. Adjust request parameters as necessary.
3. Send the request to interact with the API.

## Environment Variables

Set variables like `{{base_url}}`, `{{userId}}`, and `{{authToken}}` in your Postman environment for the collection to function correctly.

## Contributing

Contributions are welcome. Please review our contributing guidelines for more information.

## License

This collection is under the MIT License. Refer to the [LICENSE](LICENSE) file for details.
