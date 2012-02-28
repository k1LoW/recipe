# recipe - CakePHP CLI Package Installer - #

## Usage ##

1. Download only [recipe.php](https://raw.github.com/k1LoW/recipe/master/recipe.php) in your app project directory.
2. `php recipe.php`
3. Search and install package.

## Use Your Recipe ##

`recipe` can use your own recipe!!

### $ingredients ###

Set package list by `$ingredients`.

Make follow php script `myrecipe.php` like [ingredients.php](https://raw.github.com/k1LoW/recipe/master/ingredients.php),
and execute `php recipe.php -r myrecipe.php`. So you can select your packagelist.

### $recipe ###

Select install packages in advance by `$recipe`.

Make follow php script `myrecipe.php`, and execute `php recipe.php -r myrecipe.php`. So `recipe` install DebugKit, Search and Utils all at once.
    <?php
        $recipe = array('debugkit', 'search', 'utils');

### Remote recipe ###

`recipe` support remote recipe (like gist).

example.
`php recipe.php -r https://gist.github.com/1929041`

