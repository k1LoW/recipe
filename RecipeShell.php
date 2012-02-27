<?php
App::uses('Shell', 'Console');

// recipe type
define('RECIPE_TYPE_PLUGIN', 'plugin');
define('RECIPE_TYPE_COMPONENT', 'component');

// recipe archive
define('RECIPE_ARCHIVE_TARBALL', 'tarball');
define('RECIPE_ARCHIVE_FILE', 'file');

class RecipeShell extends Shell {

    public $tasks = array();
    public $results;
    public $recipePath;
    public $ingredientsPath;

    /**
     * startup
     *
     * @return
     */
    public function startup(){
        parent::startup();
    }

    /**
     * main
     *
     * @return
     */
    public function main() {
        $this->out(__d('cake_console', '<info>recipe - CakePHP CLI Package Installer - </info>'));
        $this->hr();
        $this->out(__d('cake_console', '[S]earch Package'));
        $this->out(__d('cake_console', '[Q]uit'));

        foreach ($this->params as $key => $value) {
            switch($key) {
            case 'recipe':
                if ($value) {
                    $this->recipePath = array_shift($this->args);
                }
                break;
            case 'ingredients':
                if ($value) {
                    $this->ingredientsPath = array_shift($this->args);
                }
                break;
            }
        }

        $choice = strtoupper($this->in(__d('cake_console', 'What would you like to do?'), array('S', 'Q')));
        switch ($choice) {
        case 'S':
            $this->search();
            break;
        case 'Q':
            $this->out(__d('cake_console', 'Aborted.'));
            $this->_stop();
            break;
        default:
            $this->out(__d('cake_console', 'You have made an invalid selection. Please choose a command to execute by entering S or Q.'));
        }
        $this->hr();
        $this->main();
    }

    /**
     * search
     *
     */
    private function search(){
        $response = '';
        while ($response == '') {
            $example = "search";
            $response = $this->in("Search CakePHP package\nExample: "
                                  . $example
                                  . "\n[Q]uit", null, $example);
            if (strtoupper($response) === 'Q') {
                $this->out(__d('cake_console', 'Aborted.'));
                $this->_stop();
            }
        }

        if($this->ingredientsPath) {
            require $this->ingredientsPath;
        } else {
            $url = 'https://raw.github.com/k1LoW/recipe/master/ingredients.php';
            $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . TMP . 'ingredients.php;';
            exec($cmd);
            require TMP . 'ingredients.php';
        }

        $this->ingredients = $ingredients;
        $this->results = array();
        foreach ($this->ingredients as $key => $value) {
            if (preg_match('/' . strtolower($response) . '/', $key)) {
                $value['key'] = $key;
                $this->results[] = $value;
            }
        }

        if (count($this->results) === 0) {
            $this->out(__d('cake_console', 'Can not find packages.'));
            $this->search();
            return;
        }

        $this->select();
    }

    /**
     * select
     *
     */
    private function select(){
        $this->hr();
        $this->out(__d('cake_console', 'Search result'));
        $this->hr();
        foreach ($this->results as $key => $value) {
            $this->out($key . ':' . $value['name']);
        }

        $this->out();

        $response = '';
        while ($response == '') {
            $example = "0";
            $response = $this->in("Select package\nExample: "
                                  . $example
                                  . "\n[Q]uit", null, $example);
            if (strtoupper($response) === 'Q') {
                $this->out(__d('cake_console', 'Aborted.'));
                $this->_stop();
            }
            if (isset($this->results[$response])) {
                $this->choice($this->results[$response]['key']);
            }
            $response = '';
        }
    }

    /**
     * choice
     *
     */
    private function choice($key){
        $this->hr();
        $this->out('Package Name:' . $this->ingredients[$key]['name']);
        $this->out('Author      :' . $this->ingredients[$key]['author']);
        $this->out('Description :' . $this->ingredients[$key]['description']);
        $this->out('URL         :' . $this->ingredients[$key]['url']);
        $this->hr();

        $choice = strtoupper($this->in(__d('cake_console', 'Install '. $this->ingredients[$key]['name'] .'?'), array('Y', 'N', 'Q')));
        switch ($choice) {
        case 'Y':
            $this->install($key);
            break;
        case 'N':
            break;
        case 'Q':
            $this->out(__d('cake_console', 'Aborted.'));
            $this->_stop();
        default:
            $this->out(__d('cake_console', 'You have made an invalid selection. Please choose a command to execute by entering Y, N or Q.'));
        }
    }

    /**
     * install
     *
     */
    private function install($key){
        $archive = $this->ingredients[$key]['archive'];

        switch ($archive) {
        case RECIPE_ARCHIVE_TARBALL:
            $this->_tarball($key);
            break;
        case RECIPE_ARCHIVE_FILE:
            $this->_file($key);
            break;
        default:
            break;
        }
        $this->out(__d('cake_console', 'Install complete.'));
        $this->_stop();
    }

    /**
     * _tarball
     *
     */
    private function _tarball($key){
        $name = $this->ingredients[$key]['name'];
        $url = $this->ingredients[$key]['url'];
        $type = $this->ingredients[$key]['type'];
        $archive = $this->ingredients[$key]['archive'];
        $pluginPath = APP . DS . 'Plugin' . DS;
        $componentPath = APP . DS . 'Controller/Component' . DS;

        switch($type) {
        case RECIPE_TYPE_PLUGIN:
            $fileName = 'temp.tar.gz';
            $pluginName = $name;
            $tarballName = $this->ingredients[$key]['tarballName'];
            $cmd = 'cd ' . $pluginPath . ';wget ' . $url . ' --no-check-certificate -O ' . $fileName . ';tar zxvf ' . $fileName . ';mv ' . $tarballName . ' ' . $pluginName . ';';
            exec($cmd);
            unlink($pluginPath . $fileName);
            break;
        }
    }

    /**
     * _file
     *
     */
    private function _file($key){
        $name = $this->ingredients[$key]['name'];
        $url = $this->ingredients[$key]['url'];
        $type = $this->ingredients[$key]['type'];
        $archive = $this->ingredients[$key]['archive'];
        $pluginPath = APP . DS . 'Plugin' . DS;
        $componentPath = APP . DS . 'Controller/Component' . DS;

        switch($type) {
        case RECIPE_TYPE_COMPONENT:
            $filePath = $componentPath . $name. '.php';
            $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . $filePath;
            exec($cmd);
            break;
        }
    }

    public function getOptionParser() {
        $name = $this->name;
        $parser = new ConsoleOptionParser($name, false);
        $parser->addOption('recipe', array(
                                           'short' => 'r',
                                           'help' => __d('cake_console', 'Set recipe file'),
                                           'boolean' => true
                                           ));
        $parser->addOption('ingredients', array(
                                                'short' => 'i',
                                                'help' => __d('cake_console', 'Set ingredients file'),
                                                'boolean' => true
                                                ));
        return $parser;
    }


    /**
     * help
     *
     */
    public function help() {

    }
}