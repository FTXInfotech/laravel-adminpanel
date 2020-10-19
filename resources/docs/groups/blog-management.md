# Blog Management

Class BlogsController

API's for Blog Management

## Get all Blogs.

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all blogs. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blogs?paginate=1&orderBy=officia&sortBy=facilis" \
    -H "Authorization: Bearer DPa3dg18aZV6E5hvbke4cf6" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blogs"
);

let params = {
    "paginate": "1",
    "orderBy": "officia",
    "sortBy": "facilis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer DPa3dg18aZV6E5hvbke4cf6",
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
    Order by ascending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Blog.

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Blog

> Example request:

```bash
curl -X POST \
    "/api/v1/blogs" \
    -H "Authorization: Bearer 68V1d3cbEa5ZgfDhkve4a6P" \
    -H "Content-Type: multipart/form-data" \
    -H "Accept: application/json" \
    -F "name=quod" \
    -F "publish_datetime=2020-10-16T14:12:40+0000" \
    -F "content=error" \
    -F "categories[]=dolores" \
    -F "tags[]=iusto" \
    -F "status=15" \
    -F "meta_title=dignissimos" \
    -F "cannonical_link=http://www.beatty.info/" \
    -F "meta_keywords=sit" \
    -F "meta_description=quasi" \
    -F "featured_image=@/tmp/phpQzVB7Q" 
```

```javascript
const url = new URL(
    "/api/v1/blogs"
);

let headers = {
    "Authorization": "Bearer 68V1d3cbEa5ZgfDhkve4a6P",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'quod');
body.append('publish_datetime', '2020-10-16T14:12:40+0000');
body.append('content', 'error');
body.append('categories[]', 'dolores');
body.append('tags[]', 'iusto');
body.append('status', '15');
body.append('meta_title', 'dignissimos');
body.append('cannonical_link', 'http://www.beatty.info/');
body.append('meta_keywords', 'sit');
body.append('meta_description', 'quasi');
body.append('featured_image', document.querySelector('input[name="featured_image"]').files[0]);

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
    

<code><b>categories</b></code>&nbsp; <small>array</small>     <br>
    

<code><b>tags</b></code>&nbsp; <small>array</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>integer</small>         <i>optional</i>    <br>
    

<code><b>meta_title</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>cannonical_link</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    The value must be a valid URL.

<code><b>meta_keywords</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>meta_description</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>featured_image</b></code>&nbsp; <small>file</small>         <i>optional</i>    <br>
    The value must be an image.

<code><b>categories.*</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>tags.*</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    



## Gives a specific Blog.

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Blog.
The Blog is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blogs/1" \
    -H "Authorization: Bearer vcaZegDdb8a3fE65kVh6P14" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer vcaZegDdb8a3fE65kVh6P14",
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



## Delete Blog.

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog.
The Blog to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/blogs/1" \
    -H "Authorization: Bearer eD13d4cbgahEZ66fkaP85vV" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer eD13d4cbgahEZ66fkaP85vV",
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




