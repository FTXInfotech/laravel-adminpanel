# Blog Tag Management

Class BlogTagsController

API's for Blog Tag Management

## Get all Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This enpoint provides a paginated list of all blog tags. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blog_tags?paginate=5&orderBy=ipsam&sortBy=sequi" \
    -H "Authorization: Bearer 5ZcE8fePa1Db6d3a4Vgkvh6" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_tags"
);

let params = {
    "paginate": "5",
    "orderBy": "ipsam",
    "sortBy": "sequi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer 5ZcE8fePa1Db6d3a4Vgkvh6",
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
            "id": 4,
            "name": "Laravel",
            "status": "Active",
            "created_at": "2020-07-08",
            "created_by": "Viral"
        },
        {
            "id": 5,
            "name": "Codeigniter",
            "status": "Active",
            "created_at": "2020-07-08",
            "created_by": "Viral"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/v1\/blog_tags?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/v1\/blog_tags?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/127.0.0.1:8000\/api\/v1\/blog_tags",
        "per_page": 25,
        "to": 2,
        "total": 2
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blog_tags`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>paginate</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show. Example :12

<code><b>orderBy</b></code>&nbsp;          <i>optional</i>    <br>
    Order by accending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you careate new Blog Tage

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/blog_tags" \
    -H "Authorization: Bearer DV6Eg5d6kPeaZ138f4cabvh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"pariatur"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_tags"
);

let headers = {
    "Authorization": "Bearer DV6Eg5d6kPeaZ138f4cabvh",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "pariatur"
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
> Example response (200):

```json
{
    "data": {
        "id": 7,
        "name": "Symphony 7",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/blog_tags`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    



## Update Blog Tag

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Blog Tag with new data.
The Blog Tag to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/blog_tags/1" \
    -H "Authorization: Bearer Z5aP1eEa6f4hVbdgc3Dv86k" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"incidunt"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_tags/1"
);

let headers = {
    "Authorization": "Bearer Z5aP1eEa6f4hVbdgc3Dv86k",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "incidunt"
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
        "name": "Symphony 6",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/blog_tags/{blog_tag}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/blog_tags/{blog_tag}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Tag.

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    



## Delete Blog Category

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog Category.
The Blog Category to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/blog_tags/1" \
    -H "Authorization: Bearer VadEZfD46bak856chvPg31e" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blog_tags/1"
);

let headers = {
    "Authorization": "Bearer VadEZfD46bak856chvPg31e",
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
    "message": "The blog tag was successfully deleted."
}
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/blog_tags/{blog_tag}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog Category.




