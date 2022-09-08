
## Introduction

History Registry is a simple and useful package where you can keep your history. With the history log, you can track the arrivals in an order and see who made these changes. At the same time, you can temporarily restrict the settings to watch the history or decide which events (creation, update, deletion, etc.) will be written to the table.

## Installation
```bash
composer require akiftezcan38/history-log
php artisan migrate
```
## Usage
History Log is simple to use. When you call **HistoryableTrait** into your model classes whose history you want to monitor, History Log will start to keep history for your model.
```php
    use HistoryableTrait;
```

- If you want to exclude some columns from this, add this variable to your model class globally and write the column names as an array.
```php
    protected $excludedColumns = ['deleted_at', 'id'];
```

- If you don't want to keep history in some model events, add the following variable. Currently, this version only keeps the history of create, update and delete events. A save event will be added in the future.
```php
    protected $excludedEvents = ['delete', 'create'];
```

| Id | action | table | model | model_id | column | old_value | new_value | user_id | ip_address |
| ------------ | ------------ | ------------ | ------------ | ------------ | ------------ | ------------ | ------------ | ------------ |------------|
|  1 | created  | orders  | App\Models\Order  |  5 | [["order_code"],["price"],["total_price"]]  |  [{"order_code":"ABC"},{"price":"20"},{"total_price":"20"}] | [{"order_code":"ABCD"},{"price":"30"},{"total_price":"60"}]  |  2 | 177.77.0.1 |





## Giriş

History Log veritabanı geçmişinizi tutabileceğiniz basit ve faydalı bir pakettir. History log ile bir sütunda meydana gelen değişikleri izleyebilirsiniz ve bu değişiklerin kim tarafından yapıldığını görebilirsiniz. Ayrıca opsiyonel olarak , geçmişini izleyeceğiniz sütunları kısıtlayabilir veya hangi eventlerde (create , update , delete vs.) tabloya yazacağına karar verebilirsiniz.

## Kurulum
```bash
composer require akiftezcan38/history-log
php artisan migrate
```
## Kullanım
History Log'un kullanımı basittir. Geçmişini izlemek istediğiniz model classlarınızın içine **HistoryableTrait** çağırdığınızda artık modeliniz için History Log geçmiş tutmaya başlayacak.
```php
    use HistoryableTrait;
```

- Eğer bazı sütunları bundan hariç tutmak istiyorsanız model classınızın içerisine global olarak bu değişkeni ekleyin ve array olarak sütun isimlerini yazın.

```php
    protected $excludedColumns = ['deleted_at', 'id'];
```

- Eğer bazı model eventlerinde geçmiş tutmak istemiyorsanız aşağıdaki değişkeni ekleyin. Şuan bu versyionda sadece create , update ve delete eventlerinin geçmişini tutuyor. İlerleyen zamanlarda save event da eklenecektir.

```php
    protected $excludedEvents = ['delete', 'create'];
```


| Id | action | table | model | model_id | column | old_value | new_value | user_id | ip_address |
| ------------ | ------------ | ------------ | ------------ | ------------ | ------------ | ------------ | ------------ | ------------ |------------|
|  1 | created  | orders  | App\Models\Order  |  5 | [["order_code"],["price"],["total_price"]]  |  [{"order_code":"ABC"},{"price":"20"},{"total_price":"20"}] | [{"order_code":"ABCD"},{"price":"30"},{"total_price":"60"}]  |  2 | 177.77.0.1 |
