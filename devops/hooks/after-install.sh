#!/bin/bash

# Runs inside production server.

# Project directory on server for your project.
export WEB_DIR="/home/ubuntu/sourceFromCodeDeploy"
# Your server user. Used to fix permission issue & install our project dependcies
export WEB_USER="ubuntu"

# Change directory to project.
cd $WEB_DIR

# Change user owner to ubuntu & fix storage permission issues.
sudo chown -R ubuntu:ubuntu .
sudo find . -type d -exec chmod 775 {} \;
sudo find . -type f -exec chmod 664 {} \;
sudo chgrp -R www-data storage bootstrap/cache public
sudo chmod -R ug+rwx storage bootstrap/cache public

#Install composer dependcies
sudo -u $WEB_USER composer install --no-dev --no-progress --prefer-dist --ignore-platform-reqs

#Copy .env file from S3
aws s3 cp s3://codedeploylaravellightsail/CodeDeployLaravelDem/Config/env .env

# Clear the old boostrap/cache/compiled.php
sudo -u $WEB_USER php artisan clear-compiled

# Recreate boostrap/cache/compiled.php
sudo -u $WEB_USER php artisan optimize

# run migrations
sudo -u $WEB_USER php artisan migrate --force --no-interaction
# sudo -u $WEB_USER php artisan db:seed
