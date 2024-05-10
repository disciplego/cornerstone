# New Site ToDo List

### Dgo Setup
- [x] Install Laravel
````
laravel new testdomain
````
- [ ] herd secure testdomain
- [ ] git init
- [ ] create github repo
- [ ] add github remote
````
git remote add origin git@github.com:disciplego/testdomain.git
````
#### Edit composer.json
  - [ ] app name and description
  - [ ] change "minimum-stability": "dev",
  - [ ] add Dgo repository (for local packages first)
```
"repositories": [
        {
            "type": "path",
            "url": "../packagemaker/packages/disciplego/*"
        }
    ],
"repositories": [
        {
            "type": "composer",
            "url": "https://packages.disciplego.com"
        }
    ],
```
#### Cornerstone
- [ ] Install Cornerstone Package
````
composer require disciplego/cornerstone
````
- [ ] php artisan vendor:publish --force
- [ ] php artisan tall:install
- [ ] Copy .env.example options to .env
- [ ] create testdomain database (if using mysql)
- [ ] php artisan migrate
- [ ] NPM Install & Run Build
#### Base
- [ ] Install Base Package & Assets (Seeders)
- [ ] php artisan vendor:publish --force
- [ ] Extend User Model with Dgo\BaseUser\BaseUser (delete uses and attributes)
- [ ] Migrate and Seed Database
- [ ] php artisan migrate --seed
#### Admin Panel
- [ ] Install Admin Panel Package -W
- [ ] php artisan vendor:publish --force
- [ ] Extend User Model with Dgo\AdminUser\Models\PanelUser
- [ ] Add HasFactory Trait to User Model
- [ ] php artisan filament:install --panels
- [ ] delete the AdminPanelProvider and remove from config/app.php
- [ ] php artisan shield:install
#### TALL Stack
- [ ] php artisan vendor:publish --force
- [ ] php artisan style:colors
- [ ] Extend Views and LiveWire Components with BaseComponents
- [ ] NPM Install & Run Build
- [ ] php artisan folio:install
- [ ] Delete Welcome View and Route


### Git and Staging
- [ ] Github Repo
- [ ] Launch Staging Site
