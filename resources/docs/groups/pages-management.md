# Pages Management

Class PagesController

API's for Pages Management

## Get all Pages.

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all pages. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/pages?paginate=6&orderBy=dignissimos&sortBy=voluptas" \
    -H "Authorization: Bearer had81g4ca6VPfEv65ZD3kbe" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages"
);

let params = {
    "paginate": "6",
    "orderBy": "dignissimos",
    "sortBy": "voluptas",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer had81g4ca6VPfEv65ZD3kbe",
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
            "id": 23,
            "title": "Aspernatur hic voluptatem molestiae.",
            "status_label": "<label class='label label-success'>Active<\/label>",
            "status": "Active",
            "created_at": "2020-06-26",
            "created_by": "Vipul"
        },
        {
            "id": 21,
            "title": "Commodi consequatur velit odit odit.",
            "status_label": "<label class='label label-danger'>Inactive<\/label>",
            "status": "InActive",
            "created_at": "2020-06-27",
            "created_by": "Viral"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/v1\/pages?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/v1\/pages?page=25",
        "prev": null,
        "next": "http:\/\/127.0.0.1:8000\/api\/v1\/pages?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 25,
        "path": "http:\/\/127.0.0.1:8000\/api\/v1\/pages",
        "per_page": "2",
        "to": 2,
        "total": 50
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/pages`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>paginate</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show. Example :12

<code><b>orderBy</b></code>&nbsp;          <i>optional</i>    <br>
    Order by ascending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Page.

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Page

> Example request:

```bash
curl -X POST \
    "/api/v1/pages" \
    -H "Authorization: Bearer cdD4kb5V1P8a6ahgf3E6veZ" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"sapiente","description":"laudantium","status":false,"cannonical_link":"https:\/\/www.hudson.biz\/aliquam-dicta-ex-ad-quia-harum-dolore-consectetur","seo_title":"nihil","seo_keyword":"iure","seo_description":"et"}'

```

```javascript
const url = new URL(
    "/api/v1/pages"
);

let headers = {
    "Authorization": "Bearer cdD4kb5V1P8a6ahgf3E6veZ",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "sapiente",
    "description": "laudantium",
    "status": false,
    "cannonical_link": "https:\/\/www.hudson.biz\/aliquam-dicta-ex-ad-quia-harum-dolore-consectetur",
    "seo_title": "nihil",
    "seo_keyword": "iure",
    "seo_description": "et"
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
        "id": 51,
        "title": "Page Title",
        "status_label": "<label class='label label-danger'>Inactive<\/label>",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
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
    



## Gives a specific Page.

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Page.
The Page is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/pages/1" \
    -H "Authorization: Bearer eh8vE6D4Zgk5abdP3ca1V6f" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer eh8vE6D4Zgk5abdP3ca1V6f",
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
        "id": 21,
        "title": "Commodi consequatur velit odit odit.",
        "status_label": "<label class='label label-danger'>Inactive<\/label>",
        "status": "InActive",
        "created_at": "2020-06-27",
        "created_by": "Viral"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/pages/{page}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Page.



## Delete Page.

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Page.
The Page to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/pages/1" \
    -H "Authorization: Bearer 53k8acbEDdv16fZ4ghP6Vea" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer 53k8acbEDdv16fZ4ghP6Vea",
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
    "message": "The page was successfully deleted."
}
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/pages/{page}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Page.




