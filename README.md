# Installation

1. Install dependencies : composer install
2. Update database credentials in config/app.php
3. User migrations : bin/cake migrations migrate -p CakeDC/Users
4. Create 18n table : bin/cake migrations migrate
5. Npm install admin : cd plugins/AdminTheme/webroot/assets/gulp && npm install
6. Run admin gulp : cd plugins/AdminTheme/webroot/assets/gulp && gulp

# Creating modules

1. Create table using migrations

bin/cake bake migration Create[TableName][field:type]

ex. bin/cake bake migration CreateMembers name:string

bin/cake migrations migrate

2. Create files using bake

bin/cake AdminTheme.AdminBake --table Members

3. Modify views
