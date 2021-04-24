## Article

Laravel Project  
Laravel + Inertia.js (Vue)  

Frontend made with Vue + Inertia Api responses

```
Username: dev@local.com
Password: password
```
***[Note: All users accessible via same password]***

----

REST API Endpoints:  
`POST` `/api/login`  Login  (email, password)  
Token should be included as "Bearer Token" to HTTP Headers

`GET` `/api/news`  List  Articles  
`POST` `/api/news`  Create  Article (auth)  
[title: string, content: string]  

`GET` `/api/news/{id}`   Get  Article  
`POST` `/api/news/{id}`   Update  Article (auth + owner)  
[title: string, content: string]

`DELETE` `/api/news/{id}`   Delete  Article (auth + owner)  

`GET` `/api/users/`   List Authors  
`GET` `/api/users/{id}`   Get  Author  
`POST` `/api/users/-1`   Update User Info (auth)  
[name: string, email: string]  

`GET` `/images/users/{filename}`   Get Author Image  
`GET` `/images/news/{filename}`   Get Article Image  
