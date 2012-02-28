#!/bin/bash
wget https://raw.github.com/k1LoW/recipe/master/recipe.php --no-check-certificate -O recipe.php
exec php -q recipe.php