# New Site ToDo List

### Dgo Setup
- [x] Install Laravel
- [ ] git init
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
- [ ] php artisan vendor:publish --force
- [ ] php artisan tall:install
- [ ] Copy .env.example options to .env
- [ ] Create Database
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
