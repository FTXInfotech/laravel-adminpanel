# Blog Tag Management

Class BlogTagsController

APIs for Blog Tag Management

## Get all Blog Tags

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all blog tags. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blog-tags?page=12&per_page=20&order_by=created_at&order=asc" \
    -H "Authorization: Bearer V5Ea6D8f63Pghda4vceZbk1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blog-tags"
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
    "Authorization": "Bearer V5Ea6D8f63Pghda4vceZbk1",
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
            "id": 10,
            "name": "aut",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:09",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:09",
            "updated_by": null
        },
        {
            "id": 1,
            "name": "totam",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 2,
            "name": "sed",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 3,
            "name": "consequuntur",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 4,
            "name": "vero",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 5,
            "name": "consequatur",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 6,
            "name": "non",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 7,
            "name": "saepe",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 8,
            "name": "veritatis",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 9,
            "name": "in",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        }
    ],
    "links": {
        "first": "http:\/\/laravel-starter.local\/\/api\/v1\/blog-tags?page=1",
        "last": "http:\/\/laravel-starter.local\/\/api\/v1\/blog-tags?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/laravel-starter.local\/\/api\/v1\/blog-tags",
        "per_page": 20,
        "to": 10,
        "total": 10
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog-tags`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>page</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show.

<code><b>per_page</b></code>&nbsp;          <i>optional</i>    <br>
    Number of records per page. (use -1 to retrieve all)

<code><b>order_by</b></code>&nbsp;          <i>optional</i>    <br>
    Order by database column.

<code><b>order</b></code>&nbsp;          <i>optional</i>    <br>
    Order direction ascending (asc) or descending (desc).



## Create a new Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Blog Tag

> Example request:

```bash
curl -X POST \
    "/api/v1/blog-tags" \
    -H "Authorization: Bearer 8dDaZkPvc1g3be5Vf4h66Ea" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Software","status":true}'

```

```javascript
const url = new URL(
    "/api/v1/blog-tags"
);

let headers = {
    "Authorization": "Bearer 8dDaZkPvc1g3be5Vf4h66Ea",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Software",
    "status": true
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
    "data": {
        "id": 10,
        "name": "aut",
        "status": false,
        "display_status": "InActive",
        "created_at": "2020-10-15 10:35:09",
        "created_by": "Gaylord Grimes",
        "updated_at": "2020-10-15 10:35:09",
        "updated_by": null
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/blog-tags`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    Name of the tag.

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    Status of the tag.



## Gives a specific Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Blog Tag
The Blog Tag is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blog-tags/1" \
    -H "Authorization: Bearer 6Ev6D14h3gd8aVckbf5aPeZ" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blog-tags/1"
);

let headers = {
    "Authorization": "Bearer 6Ev6D14h3gd8aVckbf5aPeZ",
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


> Example response (401, API token not provided):

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
        "id": 10,
        "name": "aut",
        "status": false,
        "display_status": "InActive",
        "created_at": "2020-10-15 10:35:09",
        "created_by": "Gaylord Grimes",
        "updated_at": "2020-10-15 10:35:09",
        "updated_by": null
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog-tags/{blog_tag}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Tag



## Update Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Blog Tag with new data.
The Blog Tag to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/blog-tags/1" \
    -H "Authorization: Bearer e4v1ha63k5PEafcbd8ZVgD6" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Software","status":true}'

```

```javascript
const url = new URL(
    "/api/v1/blog-tags/1"
);

let headers = {
    "Authorization": "Bearer e4v1ha63k5PEafcbd8ZVgD6",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Software",
    "status": true
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
        "id": 10,
        "name": "aut",
        "status": false,
        "display_status": "InActive",
        "created_at": "2020-10-15 10:35:09",
        "created_by": "Gaylord Grimes",
        "updated_at": "2020-10-19 12:03:22",
        "updated_by": "Gaylord Grimes"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/blog-tags/{blog_tag}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/blog-tags/{blog_tag}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Tag

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    Name of the tag.

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    Status of the tag.



## Delete Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog Tag
The Blog Tag to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/blog-tags/1" \
    -H "Authorization: Bearer 6EP4vVZc8bah1adekD6g5f3" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blog-tags/1"
);

let headers = {
    "Authorization": "Bearer 6EP4vVZc8bah1adekD6g5f3",
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
 **`api/v1/blog-tags/{blog_tag}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Tag




