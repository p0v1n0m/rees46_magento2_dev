# REES46 addon for CMS Magento 2

## Совместимость

* Magento 2

## 1. Установка модуля

### Ручная установка
* Перейдите на страницу модуля в Magento Marketplace: https://marketplace.magento.com/_XXX_
* Нажмите кнопку "Add to Cart" и затем оформите заказ.
* Перейдите по пути My Account > My Purchases.
* Скачайте архив с модулем и разархивируйте его.
* Скопируйте содержимое папки upload в корень сайта.
* Используя командную строку выполните следующие команды:

```php bin/magento module:enable Rees46_Personalization```

```php bin/magento setup:upgrade```

```php bin/magento setup:static-content:deploy```

### Установка с помощью Component Manager
* Перейдите на страницу модуля в Magento Marketplace: https://marketplace.magento.com/_XXX_
* Нажмите кнопку "Add to Cart" и затем оформите заказ.
* Перейдите по пути My Account > My Access Keys > Magento 2 и скопируйте Public Key и Private Key (предварительно сгенерируйте их, если это еще не сделано).
* Перейдите в административный раздел вашего сайта.
* Перейдите по пути System > Tools > Web Setup Wizard > Component Manager.
* Авторизуйтесь, используя ранее полученные Public Key и Private Key.
* Нажмите "Sync" для синхронизиции ваших модулей с Magento Marketplace.
* После синхронизации нажмите "Install".
* Поставьте галку напротив модуля "rees46/personalization" и установите его.
* Перейдите по пути Store > Settings > Configuration > Advanced > Advanced.
* Проверьте, включен ли модуль Rees46_Personalization и сохраните настройки.
* Перейдите по пути System > Tools > Cache Management и очистите кэш.

## 2. Настройка модуля

### Автоматическая настройка

![Configure](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/001.jpg)

#### Авторизация магазина

* Перейдите в административном разделе вашего сайта по пути Store > Settings > Configuration > REES46 > Settings.
* Нажмите на кнопку "Authorize".
* Заполните открывшуюся форму и нажмите "Send".

![Authorize](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/002.jpg)

В процессе авторизации автоматически производятся следующие операции:
* авторизация вашего магазина в rees46.com
* экспорт YML-ссылки
* экспорт заказов
* экспорт списка покупателей
* загрузка файлов manifest.json и push_sw.js (эти файлы используются для Web Push оповещений)

#### Регистрация магазина

* Перейдите в административном разделе вашего сайта по пути Store > Settings > Configuration > REES46 > Settings.
* Нажмите на кнопку "Register".
* Заполните открывшуюся форму и нажмите "Send".

![Register](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/003.jpg)

В процессе регистрации автоматически производятся следующие операции:
* регистрация пользователя в rees46.com
* регистрация вашего магазина в rees46.com
* авторизация вашего магазина в rees46.com
* экспорт YML-ссылки
* экспорт заказов
* экспорт списка покупателей
* загрузка файлов manifest.json и push_sw.js (эти файлы используются для Web Push оповещений)

![Actions](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/004.jpg)

### Ручная настройка (производится после автоматической настройки)

* Перейдите в административном разделе вашего сайта по пути Store > Settings > Configuration > REES46 > Settings.
* В форме настроек заполните все поля и нажмите на кнопку "Save".

![Settings](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/005.jpg)

## 3. Товарные рекомендации

* Перейдите в административном разделе вашего сайта по пути Content > Elements > Widgets.
* Нажмите "Add Widget".
* В выпадающих списках выберите виджет "REES46 Recommendations" и шаблон вашего сайта.
* Нажмите "Continue".
* На вкладке "Storefront Properties" заполните настройки расположения виджета. Привязка к необходимым страницам происходит в блоке настроек "Layout Updates".
* На вкладке "Widget Options" заполните настройки содержимого виджета.
* Нажмите на кнопку "Save".

![Settings](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/006.jpg)

![Settings](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/007.jpg)

![Settings](https://github.com/p0v1n0m/rees46_magento2_dev/blob/master/screenshots/en-gb/008.jpg)

## 4. Размещение блоков рекомендаций

Страница | Расположение | Блок рекомендаций
------------ | ------------- | -------------
Главная | Вверху страницы | "Популярные в магазине"
Главная | Внизу страницы | "Вам это будет интересно"
Главная | Внизу страницы | "Вы недавно смотрели"
Категория | Вверху страницы | "Популярные в категории"
Категория | Внизу страницы | "Вам это будет интересно"
Категория | Внизу страницы | "Вы недавно смотрели"
Товар | Вверху страницы | "Похожие"
Товар | Внизу страницы | "С этим также покупают"
Товар | Внизу страницы | "Вам это будет интересно"
Товар | Внизу страницы | "Вы недавно смотрели"
Корзина | Внизу страницы | "Посмотрите также"
Корзина | Внизу страницы | "Вам это будет интересно"
Поиск | Внизу страницы | "Искавшие это также покупают"

![magento](http://api.rees46.com/marker/magento)
