# Faq Management

Class FaqsController

APIs for Faq Management

## Get all Faq

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all faqs. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/faqs?page=12&per_page=20&order_by=created_at&order=asc" \
    -H "Authorization: Bearer PE6cZ8DdkhV1e6vabg534fa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/faqs"
);

let params = {
    "page": "12",
    "per_page": "20",
    "order_by": "created_at",
    "order": "asc",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer PE6cZ8DdkhV1e6vabg534fa",
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
    "data": [
        {
            "id": 1,
            "question": "Rerum ipsa asperiores animi voluptatem provident odio aut.",
            "answer": "Minima eveniet mollitia quis aut quo molestiae. Voluptatem et debitis laborum et delectus consequuntur enim quidem. Occaecati sit voluptate delectus aut et laudantium. Ut deleniti esse quia repudiandae ut omnis.",
            "status": 1,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "updated_at": "2020-10-15 10:35:08"
        }
    ],
    "links": {
        "first": "http:\/\/laravel-starter.local\/\/api\/v1\/faqs?page=1",
        "last": "http:\/\/laravel-starter.local\/\/api\/v1\/faqs?page=10",
        "prev": null,
        "next": "http:\/\/laravel-starter.local\/\/api\/v1\/faqs?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 10,
        "path": "http:\/\/laravel-starter.local\/\/api\/v1\/faqs",
        "per_page": 1,
        "to": 1,
        "total": 10
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/faqs`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>page</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show.

<code><b>per_page</b></code>&nbsp;          <i>optional</i>    <br>
    Number of records per page. (use -1 to retrieve all)

<code><b>order_by</b></code>&nbsp;          <i>optional</i>    <br>
    Order by database column.

<code><b>order</b></code>&nbsp;          <i>optional</i>    <br>
    Order direction ascending (asc) or descending (desc).



## Create a new Faq

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Faq

> Example request:

```bash
curl -X POST \
    "/api/v1/faqs" \
    -H "Authorization: Bearer 6V5fZhvD146gba3Eedk8acP" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"question":"cumque","answer":"eligendi","status":false}'

```

```javascript
const url = new URL(
    "/api/v1/faqs"
);

let headers = {
    "Authorization": "Bearer 6V5fZhvD146gba3Eedk8acP",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "cumque",
    "answer": "eligendi",
    "status": false
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
> Example response (201):

```json
{
    "data": {
        "id": 1,
        "question": "Rerum ipsa asperiores animi voluptatem provident odio aut.",
        "answer": "Minima eveniet mollitia quis aut quo molestiae. Voluptatem et debitis laborum et delectus consequuntur enim quidem. Occaecati sit voluptate delectus aut et laudantium. Ut deleniti esse quia repudiandae ut omnis.",
        "status": 1,
        "display_status": "Active",
        "created_at": "2020-10-15 10:35:08",
        "updated_at": "2020-10-15 10:35:08"
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/faqs`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>question</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>answer</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    



## Gives a specific Faq

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Faq
The Faq is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/faqs/1" \
    -H "Authorization: Bearer PD5a8agEefv6ck63bZ1V4dh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/faqs/1"
);

let headers = {
    "Authorization": "Bearer PD5a8agEefv6ck63bZ1V4dh",
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
    "data": {
        "id": 1,
        "question": "Rerum ipsa asperiores animi voluptatem provident odio aut.",
        "answer": "Minima eveniet mollitia quis aut quo molestiae. Voluptatem et debitis laborum et delectus consequuntur enim quidem. Occaecati sit voluptate delectus aut et laudantium. Ut deleniti esse quia repudiandae ut omnis.",
        "status": 1,
        "display_status": "Active",
        "created_at": "2020-10-15 10:35:08",
        "updated_at": "2020-10-15 10:35:08"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/faqs/{faq}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Faq



## Update Faq

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Faq with new data.
The Faq to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/faqs/1" \
    -H "Authorization: Bearer bdD51f83a6vV6hZegc4kaPE" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"question":"nobis","answer":"laudantium","status":false}'

```

```javascript
const url = new URL(
    "/api/v1/faqs/1"
);

let headers = {
    "Authorization": "Bearer bdD51f83a6vV6hZegc4kaPE",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "nobis",
    "answer": "laudantium",
    "status": false
}

fetch(url, {
    method: "PUT",
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
    "data": {
        "id": 1,
        "question": "Rerum ipsa asperiores animi voluptatem provident odio aut.",
        "answer": "Minima eveniet mollitia quis aut quo molestiae. Voluptatem et debitis laborum et delectus consequuntur enim quidem. Occaecati sit voluptate delectus aut et laudantium. Ut deleniti esse quia repudiandae ut omnis.",
        "status": 1,
        "display_status": "Active",
        "created_at": "2020-10-15 10:35:08",
        "updated_at": "2020-10-15 10:35:08"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/faqs/{faq}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/faqs/{faq}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Faq

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>question</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>answer</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    



## Delete Faq

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Faq
The Faq to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/faqs/1" \
    -H "Authorization: Bearer aVDg843cP1dakZhev56fE6b" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/faqs/1"
);

let headers = {
    "Authorization": "Bearer aVDg843cP1dakZhev56fE6b",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
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
> Example response (204, When the record is deleted):

```json
<Empty response>
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/faqs/{faq}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Faq




