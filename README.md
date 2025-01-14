
# PSN Backend Test

There is step for running the application:

## Running on local 
- Clone the repository
- Copy env.example and rename to .env, set up the database credentials.
- Run ```php artisan migrate``` to migration the table schema.
- Run ```php artisan serve``` to running the application.
- Application will run on `http://localhost:8000/`

## Running on Docker
- Clone the repository
- Copy `env.example` and rename to `.env` after that set up `.env` database as `docker-compose.yaml` config
- Run `composer install` to install all depedency
- Run `php artisan config:clear` & `php artisan cache:clear`
- Run docker compose `docker-compose up --build -d`
- Run `docker-compose exec app php artisan migrate:fresh`
- Application will running on `http://localhost/`

## Postman Collection
- https://gold-meteor-147640.postman.co/workspace/PSN-Backend-Test-API~8fd859a4-3a2e-4346-af4b-72e058774659/collection/4517781-7af61de4-7f61-4a31-a134-e47e2f009ead?action=share&creator=4517781


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
