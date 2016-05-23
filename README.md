This repo contains some basic examples for use of the Act-On API. See the [Act-On documentation](https://developer.act-on.com/documentation/) for full details.

Copy `auth.json.dist` to `auth.json` and edit it so that it contains your API credentials. You will need an Act-On developer account in order to obtain a client id and client secret.

```
% cp auth.json.dist auth.json
% vim auth.json
```

Login to get a token. Tokens are good for an hour.
```
% ./authLogin.php
Got a new token.
% cat token.json
{"token_type":"bearer","expires_in":3600,"refresh_token":"...","access_token":"...","expires_at":1464030904}
```

Refresh your token:
```
% ./authRefreshToken.php
Current token is still good, not doing anything.
```

Run your API queries:
```
% ./listList.php
There are 2 lists:
  [l-ctx] Contacts
  [l-tst] Test List
```
