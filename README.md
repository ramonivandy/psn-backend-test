
# PSN Backend Test

There is step for running the application:

## Running on local 
- Clone the repository
- Copy env.example and rename to .env, set up the database credentials.
- Run ```php artisan migrate``` to migration the table schema.
- Run ```php artisan serve``` to running the application.
- Application will run on `http://localhost:8000/`

## Running on Docker
- Cllone the repository
- Set up `docker-compose.yaml`
- Set up `.env`
- Run `php artisan config:clear` & `php artisan cache:clear`
- Run docker compose `docker-compose up --build -d`
- Run `docker-compose exec app php artisan migrate:fresh`
- Application will running on `http://localhost/`


## API Reference

#### Get all customers

```http
  GET /api/customers?page=1&size=1
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `page`      | `number` | Page for showed customer data  |
| `size`      | `number` | How many customer data want to show|

Get all customer data.

#### Get customer

```http
  GET /api/customers/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required** |

Get customer data detail

#### Create Customer

```http
  POST /api/customers
```

#### Body JSON
```json
{
    "title": required,
    "name": required,
    "gender": required,
    "phone_number": required,
    "image": required,
    "email": required
}
```

Create new customer

#### Update Customer

```http
  PUT /api/customers/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. Id of item to fetch |

#### Body JSON
```json
{
    "title": required,
    "name": required,
    "gender": required,
    "phone_number": required,
    "image": required,
    "email": required
}
```

#### Delete Customer

```http
  DELETE /api/customers/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**|

## API Reference Address

#### Create address

```http
  POST /api/address
```

#### Body JSON
```json
{
  "customer_id" : required,
  "address" : required,
  "district" : required,
  "city" : required,
  "province" : required,
  "postal_code" : required
}
```

#### Update address

```http
  PUT /api/address/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required** |

#### Body JSON
```json
{
  "customer_id" : required,
  "address" : required,
  "district" : required,
  "city" : required,
  "province" : required,
  "postal_code" : required
}
```

#### Delete address

```http
  DELETE /api/address/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required** |
