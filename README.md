## Chronolux, a watch selling E-Shop | Fullstack Semestral Task  

### 📝 Project description
This project was created as a **semestral task** for a WebDev subject at our uni. We were asked to develop fully working E-shop in PHP (Laravel). Shortly after, we went through **proper developing process**: from wireframes and prototype, through database design, frontend and backend development to actually host the website, to make it available on this [link](https://chronolux.free.nf). The website implements UI/UX design, product recommendation, sorting and filtering products, adding to cart and ordering. 
Everyone can also register to the e-shop, btw. in case, something was left in the cart while registering, the cart is automatically moved and synchronized throughout all devices, where you are logged in 😎. There is also an option to log in as an administrator. The admin has access to features such as adding products, managing the shop, and viewing statistics.
To ensure security, the application restricts access based on user roles:
- Admins cannot access regular shopping functionality or user-specific pages.
- Regular users are blocked from accessing any admin pages.

Additionally, safeguards are in place to prevent misuse or unintended behavior, like accessing protected pages (e.g. admin or payment) by manually typing the URL without proper authentication, etc.

### 🛠️ Tech stack
- **Frontend:** Blade (Laravel), CSS, JS
- **Backend:** PHP, Laravel  
- **Database:** PostgreSQL

### 🌱 Skills gained & problems overcomed
- UI/UX design (designing in Figma)
- Frontend development (HTML, CSS, Blade (Laravel), JS)
- Database design (ORM - Eloquent, PostgreSQL)
- Backend development (PHP, API)
- MVC (Model View Component), SSR (Server Side Rendering)
- Team work, GIT collaboration

## 🚀 Contributors
- Tomáš Majerčík
- Zdenko Kanoš

### 📊 Preview
Visit our project on this link https://chronolux.free.nf


### ⚙️ How to run
#### Requirements

Make sure you have the following installed:

- PHP
- Composer
- Node.js and npm
- A local database (PostgreSQL)

## 1. Clone the Repository
```bash
clone the repo
cd path/to/repo
```

## 2. Install PHP dependencies
```bash
composer install
```
NOTE: vendor/ directory is excluded via .gitignore, so dependencies must be installed locally

## 3. Install Frontend Dependencies
```bash
npm install
```
NOTE: This installs dependencies found in package.json. The node_modules/ folder is also ignored by Git

## 4. Environment Configuration
Copy the example environment file and create your own `.env`
```bash
cp .env.example .env
```
Edit `.env` with your preferred settings

## 5. Generate aplication key
```bash
php artisan key:generate
```

## 6. Migrate and seed the database
```bash
php artisan migrate --seed
```

## 7. Link storage (for uploaded files)
```bash
php artisan storage:link
```

## 8. Serve the app
```bash
php artisan serve
```
