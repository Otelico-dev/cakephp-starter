#!/bin/bash
echo "Installing dependencies"
composer install
echo "Migrating Users plugin"
bin/cake migrations migrate -p CakeDC/Users
echo "Migrating Media plugin"
bin/cake migrations migrate -p Media
echo "Migrating base tables"
bin/cake migrations migrate
echo "Creating admin assets symlinks"
bin/cake plugin assets symlink AdminTheme
