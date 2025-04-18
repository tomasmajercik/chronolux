# v provom rade databaza
- ides do `.env` a das tam 
```ini
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=WTECH-laravel #or whatever name it is
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

php artisan storage:link

   INFO  The [public/storage] link has been connected to [storage/app/public].  

# Component
php artisan make:component cartSummary

# Database
- precitaj najprv asi cele
```ini
php artisan migrate:fresh --seed
```
- mozes to nakoniec spravit aj cez toto lebo toto ti tam rovno vlozi random hodnoty ako som nastavil

- spustis prikaz:
```ini
php artisan migrate
```
- tento prikaz ti vytvori vsetky potrebne tabulky
- ked spustis tie subory a potom v nich nieco upravis a pustis znovu tak sa to nezmeni
- best practice napisat novy subor aby to potom ostatny mohli iba spustit cez ten prikaz
- ak ale potrebujes nahodou spustit znovu:
```ini
php artisan migrate:rollback
```
- spusti metodu down v migracnych filoch, kde je defaultne zmazanie tabuliek, nerobit ak su v nich data ktore chces!!

```ini
php artisan migrate:reset //toto robi to ze to resetne aj historiu vsetkych migracii co sa nachadza v db tiez
```

- vraj sa nechavaju subory ktore su default vygenerovane pokial chces pouzit autentifikaciu co podporuje laravel lebo si tam potrebuje ukladat dake veci asi aby si nevymyslal koleso

```ini
php artisan migrate:fresh --force
```
```ini
php artisan db:seed
```

# auth
- skopiruj si routy v `routes/web.php`
- `composer require laravel/breeze --dev`
- `php artisan breeze:install api`
- vrat naspat routy v `routes/web.php` ak sa prepisu (pravdepodobne ano)

- tento trapny use chybal `use Illuminate\Http\RedirectResponse;`

