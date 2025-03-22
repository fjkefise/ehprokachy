# 🚗 Система Аренды Автомобилей (Car Rental System)

<div align="center">
  <img src="screenshots/demo.png" alt="Car Rental Logo" width="300">
  
  ![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)
  ![PHP](https://img.shields.io/badge/PHP-^8.1-777BB4?style=for-the-badge&logo=php)
  ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
  ![Tailwind](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
  ![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
</div>

<p align="center">
  Современное веб-приложение для управления арендой автомобилей, разработанное на Laravel.
  <br>
  Система позволяет пользователям бронировать автомобили, а администраторам управлять автопарком и заявками на аренду.
</p>

## 📋 Содержание

- [Демонстрация](#-демонстрация)
- [Функциональность](#-функциональность)
- [Технологии](#-технологии)
- [Установка](#-установка)
- [Структура проекта](#-структура-проекта)
- [Разработка](#-разработка)
- [Лицензия](#-лицензия)
- [Автор](#-автор)

## 🖥️ Демонстрация

<div align="center">
  <img src="screenshots/demo.png" alt="Car Rental Demo" width="800">
</div>

## ✨ Функциональность

### Для пользователей
- 👤 Регистрация и авторизация
- 🔍 Просмотр доступных автомобилей
- 📅 Бронирование автомобилей на выбранные даты
- 📊 Управление своими бронированиями
- 👨‍💼 Личный кабинет с историей аренды

### Для администраторов
- 🚙 Управление автопарком (добавление/редактирование/удаление автомобилей)
- ✅ Подтверждение/отклонение заявок на бронирование
- 📈 Просмотр всех бронирований и их статусов
- 📝 Управление пользователями

## 🛠️ Технологии

- **Laravel 10.x** - PHP фреймворк
- **MySQL** - База данных
- **Tailwind CSS** - Фреймворк CSS
- **Blade** - Шаблонизатор
- **Laravel Breeze** - Аутентификация
- **Livewire** - Интерактивные компоненты

## 📥 Установка

1. Клонировать репозиторий:
```bash
git clone https://github.com/fjkefise/ehprokachy.git
cd ehprokachy
```

2. Установить зависимости:
```bash
composer install
npm install
```

3. Настроить окружение:
```bash
cp .env.example .env
php artisan key:generate
```

4. Настроить базу данных в файле `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_rental
DB_USERNAME=root
DB_PASSWORD=
```

5. Мигрировать базу данных:
```bash
php artisan migrate
```
   
   Или импортировать готовую SQL-схему:
```bash
mysql -u root -p car_rental < car_rental.sql
```

6. Запустить сборку ресурсов:
```bash
npm run build
```

7. Запустить сервер:
```bash
php artisan serve
```

## 📁 Структура Проекта

```
ehprokachy/
├── app/                  # Основной код приложения
│   ├── Http/             # Контроллеры и middleware
│   ├── Models/           # Модели данных
│   └── ...
├── database/             # Миграции и сиды
├── resources/            # Представления, JS, CSS
│   ├── views/            # Blade шаблоны
│   └── ...
├── routes/               # Определение маршрутов
├── public/               # Публичные файлы
└── ...
```

## 🧑‍💻 Разработка

Для разработки используйте:

```bash
# Запуск сервера разработки
php artisan serve

# Запуск компиляции в режиме наблюдения
npm run dev
```

## 📄 Лицензия

Этот проект распространяется под [MIT лицензией](https://opensource.org/licenses/MIT).

## 👨‍💻 Автор

Разработано [fjkefise](https://github.com/fjkefise)
