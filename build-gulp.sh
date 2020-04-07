#!/bin/bash
echo "Installing admin node modules"
(cd ./plugins/AdminTheme/webroot/assets/gulp && npm install)
echo "Building admin assets"
(cd ./plugins/AdminTheme/webroot/assets/gulp && gulp build)
echo "Installing public node modules"
(cd ./webroot/assets/gulp && npm install)
echo "Creating public assets src directories"
(cd ./webroot/assets && mkdir src && cd src && mkdir sass img js)