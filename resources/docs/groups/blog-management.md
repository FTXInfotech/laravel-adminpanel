# Blog Management

Class BlogsController

API's for Blog Management

## Get all Blogs

<small class="badge badge-darkred">requires authentication</small>

This enpoint provides a paginated list of all blogs. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blogs?paginate=1&orderBy=officiis&sortBy=et" \
    -H "Authorization: Bearer EbdVgP63hfkc5a861evZ4aD" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs"
);

let params = {
    "paginate": "1",
    "orderBy": "officiis",
    "sortBy": "et",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer EbdVgP63hfkc5a861evZ4aD",
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
            "id": 2,
            "name": "Laravel in 2020",
            "publish_datetime": "07\/07\/2020 05:24 PM",
            "status": "Published",
            "created_at": "2020-07-07",
            "created_by": "Viral Solani"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/v1\/blogs?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/v1\/blogs?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/127.0.0.1:8000\/api\/v1\/blogs",
        "per_page": 25,
        "to": 1,
        "total": 1
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blogs`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>paginate</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show. Example :12

<code><b>orderBy</b></code>&nbsp;          <i>optional</i>    <br>
    Order by accending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you careate new Blog

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/blogs" \
    -H "Authorization: Bearer cdD5aEZfe46kbgv8h13V6Pa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"natus","publish_datetime":"2020-07-08T06:07:05+0000","content":"doloremque","categories":"error","tags":"omnis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs"
);

let headers = {
    "Authorization": "Bearer cdD5aEZfe46kbgv8h13V6Pa",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "natus",
    "publish_datetime": "2020-07-08T06:07:05+0000",
    "content": "doloremque",
    "categories": "error",
    "tags": "omnis"
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
        "id": 3,
        "name": "jQuery with React",
        "publish_datetime": "07\/07\/2020 05:24 PM",
        "status": null,
        "created_at": "2020-07-08",
        "created_by": "Viral Solani"
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/blogs`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>publish_datetime</b></code>&nbsp; <small>string</small>     <br>
    The value must be a valid date.

<code><b>content</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>categories</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>tags</b></code>&nbsp; <small>string</small>     <br>
    



## Gives a specific Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Blog.
The Blog is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/blogs/1" \
    -H "Authorization: Bearer 86fb6aPZ1ca4DV5Ekde3hgv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer 86fb6aPZ1ca4DV5Ekde3hgv",
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
        "id": 2,
        "name": "Laravel in 2020",
        "publish_datetime": "07\/07\/2020 05:24 PM",
        "status": "Published",
        "created_at": "2020-07-07",
        "created_by": "Viral Solani"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blogs/{blog}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog.



## Update Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Blog with new data.
The Blog to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/blogs/1" \
    -H "Authorization: Bearer ek5V6bva864EchZ31dgPDfa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"qui","publish_datetime":"2020-07-08T06:07:05+0000","content":"et","categories":"nihil","tags":"dolorum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer ek5V6bva864EchZ31dgPDfa",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "qui",
    "publish_datetime": "2020-07-08T06:07:05+0000",
    "content": "et",
    "categories": "nihil",
    "tags": "dolorum"
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
        "id": 3,
        "name": "jQuery with React in 2020",
        "publish_datetime": "07\/07\/2020 05:24 PM",
        "status": "Published",
        "created_at": "2020-07-08",
        "created_by": "Viral Solani"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/blogs/{blog}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/blogs/{blog}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog.

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>publish_datetime</b></code>&nbsp; <small>string</small>     <br>
    The value must be a valid date.

<code><b>content</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>categories</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>tags</b></code>&nbsp; <small>string</small>     <br>
    



## Delete Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog.
The Blog to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/blogs/1" \
    -H "Authorization: Bearer vacbfaEDP613k58Vhge6Z4d" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer vacbfaEDP613k58Vhge6Z4d",
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
    "message": "The blog was successfully deleted."
}
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/blogs/{blog}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog.




