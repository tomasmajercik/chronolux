No... co som zatial robil:

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
- spustis migraciu `php artisan migrate` co ti pravdepodobne nepojde haha lebo laravel si mysli ze nevies DBSka a chce robit databazu sam cez ten `ORM`, so: vymaz databazu alebo nevymazuj len v tom .env daj nejaky iny nazov ako mas teraz a potom pleskni do terminatora `php artisan migrate:fresh`. Jo a nezabudni si tu databazu vytvorit v postge, nieze zabudnes ako ja haha


# components
- takto by mal laravel spravit component (napriklad header):
`php artisan make:component Header`
- spravi to file v `app/View/Components/Header.php` a aj v `resources/views/components/header.blade.php`
- fajn toto ked mas tak gratulujem asi 
- teraz teoria: komponent sa sklada z dvoch casti
- - `📁 resources/views/components` su Blade komponenty (HTML) – šablóny, ktoré vidíš v prehliadači 
- - `📁 app/View/Components` PHP logika komponentov – triedy, ktoré môžeš použiť na spracovanie dát, ktoré pôjdu do blade komponentu.
- - cize v kocke 🎲, `app/view/components` je akoby backend a funkcie toho frontendu ktore su v `resources/views/components`
- ok koniec teorie
-
- teraz toto hodis kod do toho `.blade.php` (napriklad, ano je tam len div):
```php
<div class="header-text">
    <h1>{{ $title }}</h1>
    <h6><i>{{ $subtitle }}</i></h6>
</div>
```
- ak to spravne chapem tak ak tento subor nazves v tej ceste `app/view/components/header.blade.php` tak ten komponent budes potom volat vsade ako `<x-header />` (tak to proste laravel robi neviem preco) a teraz predpokladam ze chces tam dat css co nie je take ez haha
- cize si spravis vo folderi `public/css/` subor napr header.css a capnes tam css, cize:`public/css/header.css`
- a teraz je ten trik, realne ten html v komponente nema ziaden link ale tam kde pouzijes ten `<x-header />` tak ten file musi mat to cssko s link na header.css ... je to taka ostara, nepaci sa mi to ale chat tvrdi ze tak to je najlepsie
- ALE
- vraj by malo ist co sami paci viac, treba skusit ci to ide dobre, ze das `import '..public/css/header.css'` a potom do toho blade das `@vite(['resources/js/app.js'])`
- lenze na to potrebujes presunut to header.css do resources/css lebo Vite pracuje s resources/, nie public/
- teraz ides do `resources/js/app.js` a das tam `import '../css/header.css'; ` (ak máš špeciálny súbor header.js, môžeš to dať tam, ale potom ho budeš musieť špeciálne volať v @vite)
- potom do toho blade das len `@vite(['resources/js/app.js'])`

-
-

- tak a teraz to chces otestovat, so v /resources/views si spravis subor napriklad home.blade.php a don das to htmlko co chces a na miesto kde patri header das `<x-header />`
- a nezabudnes v `routes/web.php` dat routing lebo ja som to tu aj napisal do .md a aj tak zabudol xd: 
```php
Route::get('/', function () {
    return view('home');
});
```
- v tomto momente zistis ze to aj tak nejde a ze to asi treba dat do toho povodneho stavu kde sa to bude linkovat. good luck



<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
