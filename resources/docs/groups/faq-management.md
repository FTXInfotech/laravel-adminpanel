# Faq Management

Class FaqsController

API's for Faq Management

## Get all Faq.

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides a paginated list of all faqs. You can customize how many records you want in each
returned response as well as sort records based on a key in specific order.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/faqs?paginate=19&orderBy=ut&sortBy=reiciendis" \
    -H "Authorization: Bearer afa68VZD1vh3g4Pdb56kEce" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/faqs"
);

let params = {
    "paginate": "19",
    "orderBy": "ut",
    "sortBy": "reiciendis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer afa68VZD1vh3g4Pdb56kEce",
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
            "id": 38,
            "question": "Sint quia aut qui nobis quidem id fuga.",
            "answer": "Voluptatem porro ut dolorem tenetur facilis suscipit. Sapiente enim sint ea et. Nihil laborum eos sunt. Dolore eligendi rerum maiores aperiam sapiente. Expedita quo harum magnam recusandae quia.",
            "status": "InActive",
            "created_at": "2020-06-26"
        },
        {
            "id": 26,
            "question": "Facilis modi ut et fuga.",
            "answer": "Inventore delectus odio in excepturi consequatur. Nihil perspiciatis consequatur doloremque voluptas aut est architecto non. Repudiandae voluptas quos consequatur atque omnis omnis.",
            "status": "InActive",
            "created_at": "2020-06-27"
        },
        {
            "id": 16,
            "question": "Nisi fugit beatae id totam consequuntur qui.",
            "answer": "Eum quibusdam voluptatum consequatur at et. Sunt eum consequuntur eveniet corrupti occaecati sequi qui nisi. Nulla unde qui similique et voluptates et. Placeat deserunt veritatis aut tenetur inventore.",
            "status": "Active",
            "created_at": "2020-06-27"
        }
    ],
    "links": {
        "first": "http:\/\/127.0.0.1:8000\/api\/v1\/faqs?page=1",
        "last": "http:\/\/127.0.0.1:8000\/api\/v1\/faqs?page=17",
        "prev": null,
        "next": "http:\/\/127.0.0.1:8000\/api\/v1\/faqs?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 17,
        "path": "http:\/\/127.0.0.1:8000\/api\/v1\/faqs",
        "per_page": "3",
        "to": 3,
        "total": 49
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/faqs`**

<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<code><b>paginate</b></code>&nbsp;          <i>optional</i>    <br>
    Which page to show. Example :12

<code><b>orderBy</b></code>&nbsp;          <i>optional</i>    <br>
    Order by ascending or descending. Example :ASC or DESC

<code><b>sortBy</b></code>&nbsp;          <i>optional</i>    <br>
    Sort by any database column. Example :created_at



## Create a new Faq.

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you create new Faq

> Example request:

```bash
curl -X POST \
    "/api/v1/faqs" \
    -H "Authorization: Bearer 3ZbPE4fd1kv68h6D5Vacgae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"question":"nostrum","answer":"quidem","status":false}'

```

```javascript
const url = new URL(
    "/api/v1/faqs"
);

let headers = {
    "Authorization": "Bearer 3ZbPE4fd1kv68h6D5Vacgae",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "nostrum",
    "answer": "quidem",
    "status": false
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
        "question": "Is this a question?",
        "answer": "Yes this is a question.",
        "status": "InActive",
        "created_at": "2020-07-08"
    }
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/v1/faqs`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>question</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>answer</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    



## Gives a specific Faq.

<small class="badge badge-darkred">requires authentication</small>

This endpoint provides you a single Faq.
The Faq is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X GET \
    -G "/api/v1/faqs/1" \
    -H "Authorization: Bearer 53a8vD1PaeVE4Zhbcfgd66k" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/faqs/1"
);

let headers = {
    "Authorization": "Bearer 53a8vD1PaeVE4Zhbcfgd66k",
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
        "id": 1,
        "question": "Nisi praesentium commodi doloribus quis dolore.",
        "answer": "Deserunt dignissimos ut repudiandae velit voluptatem ut et. Optio eos est laudantium corrupti. Corrupti non itaque corrupti ut. Est quia fugiat reprehenderit rerum in quaerat voluptatibus. Necessitatibus eos nesciunt iste dignissimos qui ea id.",
        "status": "Active",
        "created_at": "2020-07-05"
    }
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/v1/faqs/{faq}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Faq.



## Update Faq.

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to update existing Faq with new data.
The Faq to be updated is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X PUT \
    "/api/v1/faqs/1" \
    -H "Authorization: Bearer 3DfEhdgabc618av5ZVk6Pe4" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"question":"libero","answer":"itaque","status":false}'

```

```javascript
const url = new URL(
    "/api/v1/faqs/1"
);

let headers = {
    "Authorization": "Bearer 3DfEhdgabc618av5ZVk6Pe4",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "libero",
    "answer": "itaque",
    "status": false
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
        "id": 51,
        "question": "Is this a question?",
        "answer": "Yes this is a question, but it is updated.",
        "status": "InActive",
        "created_at": "2020-07-08"
    }
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/v1/faqs/{faq}`**

<small class="badge badge-purple">PATCH</small>
 **`api/v1/faqs/{faq}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Faq.

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>question</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>answer</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>status</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    



## Delete Faq.

<small class="badge badge-darkred">requires authentication</small>

This endpoint allows you to delete a Faq.
The Faq to be deleted is identified based on the ID provided as url parameter.

> Example request:

```bash
curl -X DELETE \
    "/api/v1/faqs/1" \
    -H "Authorization: Bearer eD4E15ak6ah3bc8PZvgdf6V" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/api/v1/faqs/1"
);

let headers = {
    "Authorization": "Bearer eD4E15ak6ah3bc8PZvgdf6V",
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
    "message": "The faq was successfully deleted."
}
```

### Request
<small class="badge badge-red">DELETE</small>
 **`api/v1/faqs/{faq}`**

<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<code><b>id</b></code>&nbsp;      <br>
    The ID of the Faq.




