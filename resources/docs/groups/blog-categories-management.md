# Blog Categories Management

Class BlogCategoriesController

API's for Blog Categories Management

## Get all Blog Categories

<small class="badge badge-darkred">requires authentication</small>

This enpoint provides a paginated list of all blog categories. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blog_categories?paginate=16&orderBy=nisi&sortBy=veniam" \
    -H "Authorization: Bearer 36ZfVE18kbedgvch5P4aaD6" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_categories"
);

let params = {
    "paginate": "16",
    "orderBy": "nisi",
    "sortBy": "veniam",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer 36ZfVE18kbedgvch5P4aaD6",
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
    "message": "Unauthenticated."
}
```
> Example response (200):

```json
{
    "data": [
        {
            "id": 3,
            "name": "Programming",
            "status": "Active",
            "created_at": "2020-07-07",
            "created_by": "Viral"
        },
        {
            "id": 4,
            "name": "Business Management",
            "status": "Active",
            "created_at": "2020-07-08",
            "created_by": "Viral"
        },
        {
            "id": 5,
            "name": "Software Development",
            "status": "Active",
            "created_at": "2020-07-08",
            "created_by": "Viral"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/v1\/blog_categories?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/v1\/blog_categories?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/127.0.0.1:8000\/api\/v1\/blog_categories",
        "per_page": 25,
        "to": 3,
        "total": 3
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog_categories`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>paginate</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show. Example :12

<code><b>orderBy</b></code>&nbsp;          <i>optional</i>    <br>
    Order by accending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you careate new Blog Category

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/blog_categories" \
    -H "Authorization: Bearer V6P5b64efcDkh1g8daaZ3vE" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"corporis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_categories"
);

let headers = {
    "Authorization": "Bearer V6P5b64efcDkh1g8daaZ3vE",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "corporis"
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
    "message": "Unauthenticated."
}
```
> Example response (201):

```json
{
    "data": {
        "id": 7,
        "name": "Higher Studies",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/blog_categories`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    



## Gives a specific Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Blog Category.
The Blog Category is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blog_categories/1" \
    -H "Authorization: Bearer 3aV1aP6e6vfchd5kbEZ4g8D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_categories/1"
);

let headers = {
    "Authorization": "Bearer 3aV1aP6e6vfchd5kbEZ4g8D",
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
    "message": "Unauthenticated."
}
```
> Example response (200):

```json
{
    "data": {
        "id": 7,
        "name": "Higher Studies",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog_categories/{blog_category}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category.



## Update Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Blog Category with new data.
The Blog Category to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/blog_categories/1" \
    -H "Authorization: Bearer Z8v36k6EfaacbhVdg1P4D5e" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"repellendus"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_categories/1"
);

let headers = {
    "Authorization": "Bearer Z8v36k6EfaacbhVdg1P4D5e",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "repellendus"
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
    "message": "Unauthenticated."
}
```
> Example response (200):

```json
{
    "data": {
        "id": 7,
        "name": "Higher Studies in India",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/blog_categories/{blog_category}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/blog_categories/{blog_category}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category.

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    



## Delete Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog Category.
The Blog Category to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/blog_categories/1" \
    -H "Authorization: Bearer 4Pbdk1vfeagaE6cD3hV6Z58" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_categories/1"
);

let headers = {
    "Authorization": "Bearer 4Pbdk1vfeagaE6cD3hV6Z58",
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
    "message": "Unauthenticated."
}
```
> Example response (200):

```json
{
    "message": "The blog category was successfully deleted."
}
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/blog_categories/{blog_category}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category.




