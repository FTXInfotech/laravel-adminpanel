# Pages Management

Class PagesController

APIs for Pages Management

## Get all Pages

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all pages. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/pages?page=12&per_page=20&order_by=created_at&order=asc" \
    -H "Authorization: Bearer 6PD18Ekb36V5c4gdeZavhaf" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages"
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
    "Authorization": "Bearer 6PD18Ekb36V5c4gdeZavhaf",
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
            "id": 11,
            "title": "Faith Yates",
            "description": "<p>Proident, qui pariat.<\/p>",
            "status_label": "<label class='label label-success'>Active<\/label>",
            "status": true,
            "display_status": "Active",
            "created_at": "2020-10-16 08:31:19",
            "updated_at": "2020-10-16 08:31:40",
            "created_by": "Alan Whitmore",
            "updated_by": "Alan Whitmore"
        }
    ],
    "links": {
        "first": "http:\/\/laravel-starter.local\/\/api\/v1\/pages?page=1",
        "last": "http:\/\/laravel-starter.local\/\/api\/v1\/pages?page=11",
        "prev": null,
        "next": "http:\/\/laravel-starter.local\/\/api\/v1\/pages?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 11,
        "path": "http:\/\/laravel-starter.local\/\/api\/v1\/pages",
        "per_page": 1,
        "to": 1,
        "total": 11
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/pages`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>page</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show.

<code><b>per_page</b></code>&nbsp;          <i>optional</i>    <br>
    Number of records per page. (use -1 to retrieve all)

<code><b>order_by</b></code>&nbsp;          <i>optional</i>    <br>
    Order by database column.

<code><b>order</b></code>&nbsp;          <i>optional</i>    <br>
    Order direction ascending (asc) or descending (desc).



## Create a new Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Page

> Example request:

```bash
curl -X POST \
    "/api/v1/pages" \
    -H "Authorization: Bearer Vdaf6hbePDcg65Eka31Zv48" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"rerum","description":"sunt","status":false,"cannonical_link":"http:\/\/www.hilpert.com\/enim-molestias-placeat-ab-reiciendis-veritatis-voluptas","seo_title":"aperiam","seo_keyword":"vel","seo_description":"qui"}'

```

```javascript
const url = new URL(
    "/api/v1/pages"
);

let headers = {
    "Authorization": "Bearer Vdaf6hbePDcg65Eka31Zv48",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "rerum",
    "description": "sunt",
    "status": false,
    "cannonical_link": "http:\/\/www.hilpert.com\/enim-molestias-placeat-ab-reiciendis-veritatis-voluptas",
    "seo_title": "aperiam",
    "seo_keyword": "vel",
    "seo_description": "qui"
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
        "id": 11,
        "title": "Faith Yates",
        "description": "<p>Proident, qui pariat.<\/p>",
        "status_label": "<label class='label label-success'>Active<\/label>",
        "status": true,
        "display_status": "Active",
        "created_at": "2020-10-16 08:31:19",
        "updated_at": "2020-10-16 08:31:40",
        "created_by": "Alan Whitmore",
        "updated_by": "Alan Whitmore"
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/pages`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>title</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>description</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    

<code><b>cannonical_link</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    The value must be a valid URL.

<code><b>seo_title</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>seo_keyword</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>seo_description</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    



## Gives a specific Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Page
The Page is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/pages/1" \
    -H "Authorization: Bearer 6dca6hDZ48P35vb1egfkEaV" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer 6dca6hDZ48P35vb1egfkEaV",
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
        "id": 11,
        "title": "Faith Yates",
        "description": "<p>Proident, qui pariat.<\/p>",
        "status_label": "<label class='label label-success'>Active<\/label>",
        "status": true,
        "display_status": "Active",
        "created_at": "2020-10-16 08:31:19",
        "updated_at": "2020-10-16 08:31:40",
        "created_by": "Alan Whitmore",
        "updated_by": "Alan Whitmore"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/pages/{page}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Page



## Update Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Page with new data.
The Page to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/pages/1" \
    -H "Authorization: Bearer 3cfakVb8dgP16hEDa546eZv" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"tempora","description":"in","status":false,"cannonical_link":"http:\/\/schuster.com\/","seo_title":"inventore","seo_keyword":"veniam","seo_description":"a"}'

```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer 3cfakVb8dgP16hEDa546eZv",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "tempora",
    "description": "in",
    "status": false,
    "cannonical_link": "http:\/\/schuster.com\/",
    "seo_title": "inventore",
    "seo_keyword": "veniam",
    "seo_description": "a"
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
        "id": 11,
        "title": "Faith Yates",
        "description": "<p>Proident, qui pariat.<\/p>",
        "status_label": "<label class='label label-success'>Active<\/label>",
        "status": true,
        "display_status": "Active",
        "created_at": "2020-10-16 08:31:19",
        "updated_at": "2020-10-16 08:31:40",
        "created_by": "Alan Whitmore",
        "updated_by": "Alan Whitmore"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/pages/{page}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/pages/{page}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Page

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>title</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>description</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    

<code><b>cannonical_link</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    The value must be a valid URL.

<code><b>seo_title</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>seo_keyword</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>seo_description</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    



## Delete Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Page
The Page to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/pages/1" \
    -H "Authorization: Bearer 45ac6e3kEVfhDPa81dZvg6b" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer 45ac6e3kEVfhDPa81dZvg6b",
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
 **`api/v1/pages/{page}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Page




