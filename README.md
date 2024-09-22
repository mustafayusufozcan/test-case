# Kurulum
Projeyi kurmak için `.env.example` dosyasının adını `.env` olarak değiştirin. Daha sonra sırasıyla aşağıdaki komutları çalıştırın.

```
composer install
php artisan key:generate
php artisan migrate --seed
```

Providerlardan taskları çekmek ve veritabanına kaydetmek için aşağıdaki komutu çalıştırın.

```
php artisan app:fetch-tasks
```

Providerlardan çekilen taskları developerlara atamak için aşağıdaki komutu kullanın.

```
php artisan app:assign-tasks
```

# Yeni Provider Ekleme
Projeye yeni bir provider eklemek için `app/Services` klasörü altında `ProviderInterface` arayüzünü implement eden yeni bir sınıf oluşturun ve gerekli kodları yazın. Daha sonra `config/providers.php` dosyasına oluşturduğunuz sınıfı ekleyin. 

Eklediğiniz provider için test yazmak isterseniz `tests/Unit/ProviderTest.php` dosyasına ekleme yapabilirsiniz.

# Test
Testleri çalıştırmak için aşağıdaki komutu çalıştırın.

```
php artisan test
```

# Arayüz
`http://localhost` adresine giriş yapıp taskların hangi developera atandığını ve teslim sürelerini görebilirsiniz.