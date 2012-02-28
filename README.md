# recipe - CakePHP CLI Package Installer - #

## Usage ##

1. Download only [recipe.php](https://raw.github.com/k1LoW/recipe/master/recipe.php) in your app project directory.
2. `php recipe.php`
3. Search and install package.

example.

`wget https://raw.github.com/k1LoW/recipe/master/recipe.php  --no-check-certificate -O recipe.php && php recipe.php && rm recipe.php`

## Use Your Recipe ##

`recipe` can use your own recipe!!

### $ingredients ###

Set package list by `$ingredients`.

Make php script `myrecipe.php` like [ingredients.php](https://raw.github.com/k1LoW/recipe/master/ingredients.php),
and execute `php recipe.php -r myrecipe.php`. So you can select your package list.

### $recipe ###

Select install packages in advance by `$recipe`.

Make follow php script `myrecipe.php`, and execute `php recipe.php -r myrecipe.php`. So `recipe` install DebugKit, Search and Utils all at once.

    <?php
        $recipe = array('debugkit', 'search', 'utils');

### Remote recipe ###

`recipe` support remote recipe (like gist).

example.

`php recipe.php -r https://raw.github.com/gist/1929041/536e6ac9735956d2f69af15e585be3a5907b22d0/myrecipe.php`

