#!/bin/bash
echo "Installing dependencies"
composer install
echo "Migrating Users plugin"
bin/cake migrations migrate -p CakeDC/Users
echo "Migrating Media plugin"
bin/cake migrations migrate -p Media
echo "Migrating base tables"
bin/cake migrations migrate
echo "Installing admin node modules"
(cd ./plugins/AdminTheme/webroot/assets/gulp && npm install)
echo "Building admin assets"
(cd ./plugins/AdminTheme/webroot/assets/gulp && gulp build)
echo "Installing public node modules"
(cd ./webroot/assets/gulp && npm install)
echo "Creating admin assets symlinks"
bin/cake plugin assets symlink AdminTheme
