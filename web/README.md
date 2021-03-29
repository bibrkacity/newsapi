<h2>Test task for Yuriy Maksymenko </h2>


## Task details

Реалізувати Api для розділу Новин з 3 мовами (UA, RU, EN). Додати роути з
повним CRUD (список (з пагінацією), додавання, оновлення, видалення) до
моделей posts, tags. Сутність posts і tags обовязково повинні бути
мультиязичними (з урахуванням додавання, оновлення, видалення, виводу
списка). 

Реалізувати реляційний зв'язок в MySql між таблицями posts ->
post_translations , posts -> post_tags -> tags (звязок через таблицю),
post_translations -> languages. Під час додавання, оновлення, видалення posts
враховувати мультиязичність в post_translations.

Обовязково описати всі реляційні звязки в моделях, в контролерах
використовувати патерн Репозиторій для роботи з моделями, покрити тестами
всі роути CRUD, написати міграції для бази данних з індексами і зв'язками між
таблицями.

Перелік необхідних таблиць в базі данних:
posts (поля: id, created_at, updated_at, deleted_at)
post_translations (поля: post_id, language_id, title, description, content)
tags (поля: id, name, created_at, updated_at, deleted_at)
post_tags (поля: post_id, tag_id)
languages (поля: id, locale, prefix)

В готовому тестовому завданні очікуємо побачити 2 контролера з API покриті
тестами з необхідними роутами для роботи з posts і tags.


## How to install application 

You need to have installed <a href="https://getcomposer.org/download/">composer</a> on your server. Also you need Internet-connection for server. 

1. Clone application from repository:

https://github.com/bibrkacity/newsapi.git

2. Set active directory as folder web of application's folder - in terminal. For example:

cd ~/www/newsapi/web

3. Run command in terminal:

composer update

3. Save  file web/.env.example as web/.env and edit parameters of MySQL-connection in web/.env. For example:

<pre>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newsapi
DB_USERNAME=newsapi
DB_PASSWORD=Z58q8DEz5_NCAa-(</pre>

4. Run migrations in terminal:

php artisan migrate

<p style="font-style:italic;margin-left:2em">If you have error "class not found" - try to run <br />composer dump-autoload</p>

5. Run seeds in terminal:

php artisan db:seed

6. Run built-in Web-server:

php artisan serve

7. Go to http://127.0.0.1:8000

May be you see proposal to generate Application Key. Click this button. Or type in terminal:

php artisan key:generate

8. Read comments in start page (http://127.0.0.1:8000)




