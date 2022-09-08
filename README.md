
```php
php artisan db:seed --class=ReducePhotosSizeAndGenerateThumbnailSeeder
```

```mysql
ALTER TABLE `Blog` CHANGE `Contents` `Contents` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NULL DEFAULT NULL;
```
