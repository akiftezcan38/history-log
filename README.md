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