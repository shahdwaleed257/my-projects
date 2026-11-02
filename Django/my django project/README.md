# Django — Client Management Demo Site

A small Django website that displays a list of clients stored in SQLite.

## Features

- `pages` app with a **Home** page and a **Clients** page that lists clients from the database
- `Client` model: name, email, phone, company, status and image
- Template inheritance (`base.html`, shared navbar and footer), custom CSS and JavaScript, static images
- Django admin for adding clients (`/admin/`)

## Run locally

```bash
cd myproject
python -m venv venv
venv\Scripts\activate          # Windows  (Linux/macOS: source venv/bin/activate)
pip install django
python manage.py migrate
python manage.py createsuperuser   # optional, to use the admin
python manage.py runserver
```

Then open http://127.0.0.1:8000/ (home) and http://127.0.0.1:8000/clients/.

## Project structure

```
myproject/
├── manage.py
├── myproject/        # project settings and root URLs
├── pages/            # app: models, views, urls, templates
└── static/           # css, js, images
```
