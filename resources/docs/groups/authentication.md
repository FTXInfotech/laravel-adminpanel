# Authentication

Class AuthController

Fullfills all aspects related to authenticate a user.

## Attempt to login the user.


If login is successfull, you get an api_token in response. Use that api_token to authenticate yourself for further api calls.

> Example request:

```bash
curl -X POST \
    "/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"\"user@test.com\"","password":"\"abc@123_4\""}'

```

```javascript
const url = new URL(
    "/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "\"user@test.com\"",
    "password": "\"abc@123_4\""
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401, api_key not provided):

```json
{
    "error": {
        "message": "Unauthenticated.",
        "status_code": 401
    }
}
```
> Example response (200):

```json
{
    "message": "Login Successfull.",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTc1YjM0YmQ2Y2U5OWE3YTIwMTcxODY4NDcyNjJlOTRiOGYzZTExNTNjN2RhMzA0YzgwM2Q0NmY3YWVmMzRkMDFhZGIxY2JlY2M1YWZjNjUiLCJpYXQiOjE1OTQxOTA5MjksIm5iZiI6MTU5NDE5MDkyOSwiZXhwIjoxNjI1NzI2OTI5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.jkoXYrKQ9pV9qB1Kn4jIxBoSKSWYX3SgjFoefxdH9ZzDA2-XPAp7OFt1yHCjrzM3UJFSzd2BLNGQQmK-CE9-IAhz7DGQAnR7HIuTLGA2ze7mTR2BHofZe-KN0b-RXM_rEsDZLp-qX4zPS4hiJK38KCLM39TVPTZ4TcdvfgNwa1yqsAZko-kQ0-yCi4FkGExeogNuZwJ6ZsfQC-mW0QaPTgsDBXk7tXE4pd6kkDxTHSA-fo8-oL16UoFu70IxCQ8njVwpLJ6-Avb3TRtaedPGVeE8qja93Ly6QUnMns5yJSsKGjXRTTS-2vHCzPXcuW1eEQatwhD-ZMnLuLTHfQlSHz3q6Artqzpw9JjRNf3Fx7W2g4yBhs8FF-3nUl1B2nY2_uuPMoRdfFsrnHl4i7C-9cVAWQl34b4OmZyEf41Sqk1qvNnEUV3YJUcyO46iwAgSs2yuZ5fTQxCGVbMBJwfVAjgHBfozp2lqE2BixQwcRrU33H41JAQK3zRNmPuAOeODZisZkSYvdgRwJ5-GDJ0z9oHanrSrH4bfGbD5qPHp8PdE3Yez3UP0UxImDY7lX_d3_8iHbkNkrVDoOcvSOUqvqhjbVyCrnE9WzXBi9_igLZSff3Pwb6shVMnWLfUs9NpDXSDNFpwUm_O2rIhoLAmO78a3uwTxiYmBz1p3TmL0ZW0"
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/auth/login`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>email</b></code>&nbsp; <small>string</small>     <br>
    Your email id.

<code><b>password</b></code>&nbsp; <small>string</small>     <br>
    Your Password.



## Attempt to logout the user.


After successfull logut the token get invalidated and can not be used further.

> Example request:

```bash
curl -X POST \
    "/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401, api_key not provided):

```json
{
    "error": {
        "message": "Unauthenticated.",
        "status_code": 401
    }
}
```
> Example response (200):

```json
{
    "message": "Successfully logged out."
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/auth/logout`**



## Get the authenticated User.




> Example request:

```bash
curl -X GET \
    -G "/api/v1/auth/me" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/auth/me"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401, api_key not provided):

```json
{
    "error": {
        "message": "Unauthenticated.",
        "status_code": 401
    }
}
```
> Example response (200):

```json
{
    "id": 1,
    "uuid": "f62b88c6-36a4-4fbf-b7f3-03a62749ddd7",
    "first_name": "Viral",
    "last_name": "Solani",
    "email": "admin@admin.com",
    "avatar_type": "gravatar",
    "avatar_location": null,
    "password_changed_at": null,
    "active": true,
    "confirmation_code": "0ad265176572464826b6a61aaf98c4e0",
    "confirmed": true,
    "timezone": "America\/New_York",
    "last_login_at": "2020-07-07 14:46:43",
    "last_login_ip": "127.0.0.1",
    "to_be_logged_out": false,
    "status": 1,
    "created_by": 1,
    "updated_by": null,
    "is_term_accept": 0,
    "created_at": "2020-07-06 13:54:13",
    "updated_at": "2020-07-07 14:46:43",
    "deleted_at": null,
    "full_name": "Viral Solani"
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/auth/me`**




