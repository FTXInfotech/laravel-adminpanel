# Pages Management

Class PagesController

API's for Pages Management

## Get all Pages

<small class="badge badge-darkred">requires authentication</small>

This enpoint provides a paginated list of all pages. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/pages?paginate=14&orderBy=inventore&sortBy=nulla" \
    -H "Authorization: Bearer ec4gkdEvfZ35Va61h6bD8Pa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages"
);

let params = {
    "paginate": "14",
    "orderBy": "inventore",
    "sortBy": "nulla",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer ec4gkdEvfZ35Va61h6bD8Pa",
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
    Order by accending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you careate new Page

> Example request:

```bash
curl -X POST \
    "/api/v1/pages" \
    -H "Authorization: Bearer 6e68Padv5ck1DfZa4hgVE3b" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"perspiciatis","description":"debitis"}'

```

```javascript
const url = new URL(
    "/api/v1/pages"
);

let headers = {
    "Authorization": "Bearer 6e68Padv5ck1DfZa4hgVE3b",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "perspiciatis",
    "description": "debitis"
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
    



## Gives a specific Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Page.
The Page is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/pages/1" \
    -H "Authorization: Bearer vhPf31eVak665Zd4bacDg8E" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer vhPf31eVak665Zd4bacDg8E",
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



## Update Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Page with new data.
The Page to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/pages/1" \
    -H "Authorization: Bearer fVe6E5gPv1Zhkaba8dc6D43" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"maiores","description":"quas"}'

```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer fVe6E5gPv1Zhkaba8dc6D43",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "maiores",
    "description": "quas"
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
        "id": 51,
        "title": "Page Title Updated",
        "status_label": "<label class='label label-danger'>Inactive<\/label>",
        "status": "InActive",
        "created_at": "2020-07-08",
        "created_by": "Viral"
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
    The ID of the Page.

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>title</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>description</b></code>&nbsp; <small>string</small>     <br>
    



## Delete Page

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Page.
The Page to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/pages/1" \
    -H "Authorization: Bearer eaE1bhZP46Dagv8Vkcdf563" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/pages/1"
);

let headers = {
    "Authorization": "Bearer eaE1bhZP46Dagv8Vkcdf563",
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
    "message": "The page was successfully deleted."
}
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/pages/{page}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Page.




