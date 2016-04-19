Social mining and visualization tool
====================================

This repository provides 4 REST endpoints for retrieving data from a Facebook page and visualization of a page's fans by country.

### Documentation

#### Getting Started

```
git clone https://github.com/kvprashant/fb-digi.git <YOUR_PROJECT>
cd path/to/YOUR_PROJECT

npm install
composer install

php artisan migrate
php artisan vendor:publish --tag=public --force

gulp --production

cp .env.example .env
php artisan key:generate
```

Make sure you set your `APP_URL` environment variable to your current hosting domain. 

Other important environment variables are: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `FACEBOOK_APP_ID`, `FACEBOOK_APP_SECRET`

#### Retrieve a page name
`curl --user username:password http://hosting.domain/api/v1/`


#### Retrieve the latest `n` posts
`curl --user username:password http://hosting.domain/api/v1/posts?page=cocacolanetherlands&limit=n`

#### Retrieve the latest `n` posts ordered by number of likes
`curl --user username:password http://hosting.domain/api/v1/posts_ordered_by_likes?page=cocacolanetherlands&limit=n`

#### Retrieve the top 5 users who have liked `n` posts
`curl --user username:password http://hosting.domain/api/v1/top_user_likes?page=cocacolanetherlands&limit=n`

### Visualization of a Facebook page's fans by country
`http://hosting.domain/visualization`

Login using the credentials and you will be able to see the visualization of KPN's page
