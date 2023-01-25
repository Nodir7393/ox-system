# Ox-System

[Symfony](https://symfony.com/) php frameworki yordamida tovarlar bilan ishlash bo'yicha Rest api metodini qo'llagan xolda loyiha yaratish. Loyihada tovarlar turlari bilan qo'shilishi kerak,
masalan: tovar T-shirt, turlari Size-XL, Color- Black. Loyiha Rest Api methodiga mos ravishda qurilishi kerak. Api ga so'rov jo'natish faqat ruxsat etilgan userlargagina mumkin bo'lsin, Authentication ga [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) dan fodalanilsin

Qoshimcha qo'lanishi kerak bo'lganlar: <br />
Database: [postgresql](https://www.postgresql.org/) <br />
Doctrine: [ORM](https://symfony.com/doc/current/doctrine.html) <br />
Formalar bilan ishlashga: [FormType](https://symfony.com/doc/current/forms.html) <br />

# API

## installations

### `symfony composer install`
### `symfony console doctrine:migrations:migrate`
### `symfony serve`
[https://127.0.0.1:8000/api](https://127.0.0.1:8000/api)

# REACT ADMIN

src: /admin
### `npm install`
### `npm start`
[http://localhost:3000](http://localhost:3000)