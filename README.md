# REES46 addon for CMS Magento 2

## Совместимость

* Magento 2

## 1. Установка модуля

# Ручная установка
* Перейдите на страницу модуля в Magento Marketplace: https://marketplace.magento.com/_XXX_
* Нажмите кнопку "Add to Cart" и затем оформите заказ.
* Перейдите по пути My Account > My Purchases.
* Скачайте архив с модулем и разархивируйте его.
* Скопируйте содержимое папки upload в корень сайта.
* Используя командную строку выполните следующие команды:
php bin/magento module:enable Rees46_Personalization
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy

# Установка с помошью Component Manager
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

* Перейдите в административный раздел вашего сайта.
* Перейдите по пути Store > Settings > Configuration > REES46 > Settings.
* 

## 9. Таблица установки блоков рекомендаций

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

![magento](http://api.rees46.com/marker/prestashop)
