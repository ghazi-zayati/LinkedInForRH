php bin/console doctrine:schema:update --force
rm -rf ./var/cache
chmod -R 777 ./