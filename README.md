# Lawyers Project — Полный WordPress-проект: Кастомная тема + плагин

Этот репозиторий содержит **полноценный WordPress-проект**, разработанный с нуля.  
Включает **кастомную тему** и **плагин**, а также собственные виджеты для Elementor, поддержку ACF и настройки через Redux Framework.

---

## 🎨 Кастомная тема (`themes/lawyers/`)

**Возможности:**

- Собственная адаптивная тема
- Современный дизайн для юридической компании
- Интеграция с Redux Framework (настройки хедера, футера, контактов)
- Использование ACF для вывода даты в новостях
- Локализация через `.pot` файл

---

## 🔌 Кастомный плагин (`plugins/lawyers/`)

Плагин реализует кастомный тип записей:

- `services` — услуги, с таксономией
- `news` — новости, с таксономией
- Регистрируется через `register_post_type()` и `register_taxonomy()`
- Легко масштабируется под другие типы данных

---

## 🧩 Кастомные Elementor-виджеты (`themes/lawyers/widgets/`)

Реализованы вручную на базе API Elementor:

- `about-widget.php` — блок о юридическая компании
- `lawyers-widget.php` — блок о юристах для вывода используется REPEATER
- `main-widget.php` — главный блок
- `news-widget.php` — блок новостей с датой публикации (ACF)
- `news-widget.php` — блок с отзывами для вывода отзывов используется REPEATER
- `services-widget.php` — карточки с услугами и иконками

Подключаются в `functions.php`, отображаются в интерфейсе Elementor как собственные виджеты.

---

## 🛠 Используемые технологии

- WordPress
- PHP
- HTML5, CSS3
- ACF (Advanced Custom Fields)
- Redux Framework
- Elementor (custom widgets)
- WP Query
- CPT & Taxonomies
- Responsive Layout

---

## 🧪 Как протестировать

1. Скачайте проект (зелёная кнопка `Code → Download ZIP`)  
2. Распакуйте `wp-content/` в вашу локальную сборку WordPress
3. Активируйте:
   - тему **Lawyers**
   - плагин **Lawyers CPT**
4. Установите и активируйте плагины:
   - [ACF](https://wordpress.org/plugins/advanced-custom-fields/)
   - [Redux Framework](https://wordpress.org/plugins/redux-framework/)
   - [Elementor](https://wordpress.org/plugins/elementor/)
5. Зайдите в Elementor → виджеты → найдите **News** и **Services**
6. Добавьте CPT-записи "Услуги", создайте страницу и настройте контент

---

## 📸 Скриншоты

| Главная | Услуги | Новости |
|--------|--------|---------|
| ![](./wp-content/themes/lawyers/screenshots/preview-1.png) | ![](./wp-content/themes/lawyers/screenshots/preview-2.png) | ![](./wp-content/themes/lawyers/screenshots/preview-3.png) |

---

## 🙋‍♂️ Автор

**Georgy123321** — начинающий WordPress-разработчик.  
Проект реализован как часть практики и демонстрации навыков работы с темами, плагинами и кастомными блоками.

---

## 📄 Лицензия

MIT / GPL — свободно для ознакомления и учебных целей.
