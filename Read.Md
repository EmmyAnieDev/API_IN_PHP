1: To install the dotenv library, run: composer require vlucas/phpdotenv
2: To generate autoload files, run: composer dump-autoload
3: API key is a unique string of characters that identify a user's account
4: Access token allow us to authorize request to the API without doing a database lookup
5: Access token contains details of what was successfully authenticated above

JWTs are used in token-based authentication, allowing users to authenticate once and access protected
resources without re-authenticating.

Typically, a JWT contains three parts separated by dots (.):

1: Header - Specifies the type of token (JWT) and the hashing algorithm. HS256
2: Payload - Contains claims (data) about the user or session.
3: Signature - Verifies the token's authenticity and prevents tampering. Formed by creating the hash of other 2 values above

- ADDED SECRET KEY TO THE .ENV FILE

- Now the task API requires Authentication, but when we do authenticate it, we don't need to make request to the database.
- The authentication takes place just once (upon login),
- and the access token obtained can be used to authenticate request to those pages that requires authentication
