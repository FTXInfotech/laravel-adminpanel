# Blog Management

Class BlogsController

APIs for Blog Management

## Get all Blogs

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all blogs. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blogs?page=12&per_page=20&order_by=created_at&order=asc" \
    -H "Authorization: Bearer Zga3b51D6EkaPf4eh6v8cVd" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blogs"
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
    "Authorization": "Bearer Zga3b51D6EkaPf4eh6v8cVd",
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
            "id": 16,
            "name": "Chantale Pope Abc",
            "publish_datetime": "23\/10\/2020 12:53 PM",
            "content": "<p>Et est, perferendis .<\/p>",
            "meta_title": "Hic vero eius expedi",
            "cannonical_link": "https:\/\/www.google.com",
            "meta_keywords": "Qui aspernatur velit",
            "meta_description": "<p>Quae lorem rem in ea.<\/p>",
            "status": 2,
            "display_status": "Draft",
            "categories": [
                {
                    "id": 2,
                    "name": "quia ut optio",
                    "status": true,
                    "display_status": "Active",
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
                }
            ],
            "tags": [
                {
                    "id": 2,
                    "name": "sed",
                    "status": true,
                    "display_status": "Active",
                    "created_at": "2020-10-15 10:35:08",
                    "created_by": "Gaylord Grimes",
                    "updated_at": "2020-10-15 10:35:08",
                    "updated_by": null
                }
            ],
            "created_at": "2020-10-16",
            "created_by": "Alan Whitmore",
            "updated_at": "2020-10-16 07:42:41",
            "updated_by": "Alan Whitmore"
        }
    ],
    "links": {
        "first": "http:\/\/laravel-starter.local\/\/api\/v1\/blogs?page=1",
        "last": "http:\/\/laravel-starter.local\/\/api\/v1\/blogs?page=15",
        "prev": null,
        "next": "http:\/\/laravel-starter.local\/\/api\/v1\/blogs?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 15,
        "path": "http:\/\/laravel-starter.local\/\/api\/v1\/blogs",
        "per_page": 1,
        "to": 1,
        "total": 15
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blogs`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>page</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show.

<code><b>per_page</b></code>&nbsp;          <i>optional</i>    <br>
    Number of records per page. (use -1 to retrieve all)

<code><b>order_by</b></code>&nbsp;          <i>optional</i>    <br>
    Order by database column.

<code><b>order</b></code>&nbsp;          <i>optional</i>    <br>
    Order direction ascending (asc) or descending (desc).



## Create a new Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Blog

> Example request:

```bash
curl -X POST \
    "/api/v1/blogs" \
    -H "Authorization: Bearer 1Va38DZeakEc6db65hg4Pfv" \
    -H "Content-Type: multipart/form-data" \
    -H "Accept: application/json" \
    -F "name=a" \
    -F "publish_datetime=2020-10-19T10:21:17+0000" \
    -F "content=pariatur" \
    -F "categories[]=veritatis" \
    -F "tags[]=voluptates" \
    -F "status=14" \
    -F "meta_title=reprehenderit" \
    -F "cannonical_link=http://oberbrunner.com/odio-inventore-ea-qui-nihil-est-unde" \
    -F "meta_keywords=illum" \
    -F "meta_description=culpa" \
    -F "featured_image=@/tmp/phplFpFJg" 
```

```javascript
const url = new URL(
    "/api/v1/blogs"
);

let headers = {
    "Authorization": "Bearer 1Va38DZeakEc6db65hg4Pfv",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'a');
body.append('publish_datetime', '2020-10-19T10:21:17+0000');
body.append('content', 'pariatur');
body.append('categories[]', 'veritatis');
body.append('tags[]', 'voluptates');
body.append('status', '14');
body.append('meta_title', 'reprehenderit');
body.append('cannonical_link', 'http://oberbrunner.com/odio-inventore-ea-qui-nihil-est-unde');
body.append('meta_keywords', 'illum');
body.append('meta_description', 'culpa');
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
        "id": 16,
        "name": "Chantale Pope Abc",
        "publish_datetime": "23\/10\/2020 12:53 PM",
        "content": "<p>Et est, perferendis .<\/p>",
        "meta_title": "Hic vero eius expedi",
        "cannonical_link": "https:\/\/www.google.com",
        "meta_keywords": "Qui aspernatur velit",
        "meta_description": "<p>Quae lorem rem in ea.<\/p>",
        "status": 2,
        "display_status": "Draft",
        "categories": [
            {
                "id": 2,
                "name": "quia ut optio",
                "status": true,
                "display_status": "Active",
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
            }
        ],
        "tags": [
            {
                "id": 2,
                "name": "sed",
                "status": true,
                "display_status": "Active",
                "created_at": "2020-10-15 10:35:08",
                "created_by": "Gaylord Grimes",
                "updated_at": "2020-10-15 10:35:08",
                "updated_by": null
            }
        ],
        "created_at": "2020-10-16",
        "created_by": "Alan Whitmore",
        "updated_at": "2020-10-16 07:42:41",
        "updated_by": "Alan Whitmore"
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
    



## Gives a specific Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Blog
The Blog is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/blogs/1" \
    -H "Authorization: Bearer e6kdfv86aPg53EaD1cVhb4Z" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer e6kdfv86aPg53EaD1cVhb4Z",
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
        "id": 16,
        "name": "Chantale Pope Abc",
        "publish_datetime": "23\/10\/2020 12:53 PM",
        "content": "<p>Et est, perferendis .<\/p>",
        "meta_title": "Hic vero eius expedi",
        "cannonical_link": "https:\/\/www.google.com",
        "meta_keywords": "Qui aspernatur velit",
        "meta_description": "<p>Quae lorem rem in ea.<\/p>",
        "status": 2,
        "display_status": "Draft",
        "categories": [
            {
                "id": 2,
                "name": "quia ut optio",
                "status": true,
                "display_status": "Active",
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
            }
        ],
        "tags": [
            {
                "id": 2,
                "name": "sed",
                "status": true,
                "display_status": "Active",
                "created_at": "2020-10-15 10:35:08",
                "created_by": "Gaylord Grimes",
                "updated_at": "2020-10-15 10:35:08",
                "updated_by": null
            }
        ],
        "created_at": "2020-10-16",
        "created_by": "Alan Whitmore",
        "updated_at": "2020-10-16 07:42:41",
        "updated_by": "Alan Whitmore"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/blogs/{blog}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog



## Update Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Blog with new data.
The Blog to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/blogs/1" \
    -H "Authorization: Bearer 6vckV8fbheZ5E4PaD63ad1g" \
    -H "Content-Type: multipart/form-data" \
    -H "Accept: application/json" \
    -F "name=excepturi" \
    -F "publish_datetime=2020-10-19T10:21:17+0000" \
    -F "content=dolores" \
    -F "categories[]=atque" \
    -F "tags[]=ut" \
    -F "status=18" \
    -F "meta_title=sint" \
    -F "cannonical_link=http://armstrong.com/aut-quia-asperiores-doloribus-ipsum-quae-numquam-in-tenetur" \
    -F "meta_keywords=qui" \
    -F "meta_description=quisquam" \
    -F "featured_image=@/tmp/phpVrZBcA" 
```

```javascript
const url = new URL(
    "/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer 6vckV8fbheZ5E4PaD63ad1g",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('name', 'excepturi');
body.append('publish_datetime', '2020-10-19T10:21:17+0000');
body.append('content', 'dolores');
body.append('categories[]', 'atque');
body.append('tags[]', 'ut');
body.append('status', '18');
body.append('meta_title', 'sint');
body.append('cannonical_link', 'http://armstrong.com/aut-quia-asperiores-doloribus-ipsum-quae-numquam-in-tenetur');
body.append('meta_keywords', 'qui');
body.append('meta_description', 'quisquam');
body.append('featured_image', document.querySelector('input[name="featured_image"]').files[0]);

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
        "id": 16,
        "name": "Chantale Pope Abc",
        "publish_datetime": "23\/10\/2020 12:53 PM",
        "content": "<p>Et est, perferendis .<\/p>",
        "meta_title": "Hic vero eius expedi",
        "cannonical_link": "https:\/\/www.google.com",
        "meta_keywords": "Qui aspernatur velit",
        "meta_description": "<p>Quae lorem rem in ea.<\/p>",
        "status": 2,
        "display_status": "Draft",
        "categories": [
            {
                "id": 2,
                "name": "quia ut optio",
                "status": true,
                "display_status": "Active",
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
            }
        ],
        "tags": [
            {
                "id": 2,
                "name": "sed",
                "status": true,
                "display_status": "Active",
                "created_at": "2020-10-15 10:35:08",
                "created_by": "Gaylord Grimes",
                "updated_at": "2020-10-15 10:35:08",
                "updated_by": null
            }
        ],
        "created_at": "2020-10-16",
        "created_by": "Alan Whitmore",
        "updated_at": "2020-10-16 07:42:41",
        "updated_by": "Alan Whitmore"
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
    The ID of the Blog

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
    



## Delete Blog

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Blog
The Blog to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/blogs/1" \
    -H "Authorization: Bearer bVe5c3hPkd8gD6aaZ64vEf1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/blogs/1"
);

let headers = {
    "Authorization": "Bearer bVe5c3hPkd8gD6aaZ64vEf1",
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
 **`api/v1/blogs/{blog}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Blog




