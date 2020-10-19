# Blog Categories Management

Class BlogCategoriesController

APIs for Blog Categories Management

## Get all Blog Categories

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all blog categories. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blog-categories?page=12&per_page=20&order_by=created_at&order=asc" \
    -H "Authorization: Bearer d16cZ5hvD8ba43P6eagEVkf" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blog-categories"
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
    "Authorization": "Bearer d16cZ5hvD8ba43P6eagEVkf",
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
    "data": [
        {
            "id": 9,
            "name": "ipsum reiciendis ut",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 10,
            "name": "possimus et omnis",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 1,
            "name": "harum quas vel",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 8,
            "name": "sunt ducimus recusandae",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 7,
            "name": "aut voluptates veritatis",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 6,
            "name": "fugit impedit quia",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 5,
            "name": "et et in",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 4,
            "name": "sapiente hic ad",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 3,
            "name": "ut rerum voluptate",
            "status": false,
            "display_status": "InActive",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        },
        {
            "id": 2,
            "name": "quia ut optio",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-15 10:35:08",
            "created_by": "Gaylord Grimes",
            "updated_at": "2020-10-15 10:35:08",
            "updated_by": null
        }
    ],
    "links": {
        "first": "http:\/\/laravel-starter.local\/\/api\/v1\/blog-categories?page=1",
        "last": "http:\/\/laravel-starter.local\/\/api\/v1\/blog-categories?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/laravel-starter.local\/\/api\/v1\/blog-categories",
        "per_page": 20,
        "to": 10,
        "total": 10
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog-categories`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>page</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show.

<code><b>per_page</b></code>&nbsp;          <i>optional</i>    <br>
    Number of records per page. (use -1 to retrieve all)

<code><b>order_by</b></code>&nbsp;          <i>optional</i>    <br>
    Order by database column.

<code><b>order</b></code>&nbsp;          <i>optional</i>    <br>
    Order direction ascending (asc) or descending (desc).



## Create a new Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Blog Category

> Example request:

```bash
curl -X POST \
    "/api/v1/blog-categories" \
    -H "Authorization: Bearer aD6E8d3g1baek64c5fZVhvP" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Software","status":true}'

```

```javascript
const url = new URL(
    "/api/v1/blog-categories"
);

let headers = {
    "Authorization": "Bearer aD6E8d3g1baek64c5fZVhvP",
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


> Example response (401, API token not provided):

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
        "name": "ipsum reiciendis ut",
        "status": false,
        "display_status": "InActive",
        "created_at": "2020-10-15 10:35:08",
        "created_by": "Gaylord Grimes",
        "updated_at": "2020-10-15 10:35:08",
        "updated_by": null
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/blog-categories`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    Name of the category.

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    Status of the category.



## Gives a specific Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Blog Category
The Blog Category is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blog-categories/1" \
    -H "Authorization: Bearer D36keP1cVfbda54haEgZv86" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blog-categories/1"
);

let headers = {
    "Authorization": "Bearer D36keP1cVfbda54haEgZv86",
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
        "id": 1,
        "name": "ipsum reiciendis ut",
        "status": false,
        "display_status": "InActive",
        "created_at": "2020-10-15 10:35:08",
        "created_by": "Gaylord Grimes",
        "updated_at": "2020-10-15 10:35:08",
        "updated_by": null
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog-categories/{blog_category}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category



## Update Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Blog Category with new data.
The Blog Category to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/blog-categories/1" \
    -H "Authorization: Bearer vEba3D86ce46PZakd5f1gVh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Software","status":true}'

```

```javascript
const url = new URL(
    "/api/v1/blog-categories/1"
);

let headers = {
    "Authorization": "Bearer vEba3D86ce46PZakd5f1gVh",
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
        "id": 1,
        "name": "ipsum reiciendis ut",
        "status": true,
        "display_status": "Active",
        "created_at": "2020-10-15 10:35:08",
        "created_by": "Gaylord Grimes",
        "updated_at": "2020-10-15 10:38:02",
        "updated_by": null
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/blog-categories/{blog_category}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/blog-categories/{blog_category}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    Name of the category.

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    Status of the category.



## Delete Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog Category
The Blog Category to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/blog-categories/1" \
    -H "Authorization: Bearer a64P5E6cdbfkaDV13Zgh8ve" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blog-categories/1"
);

let headers = {
    "Authorization": "Bearer a64P5E6cdbfkaDV13Zgh8ve",
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


> Example response (401, API token not provided):

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
 **`api/v1/blog-categories/{blog_category}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category




