<?php
App::uses('Shell', 'Console');
App::uses('Set', 'Utility');

// recipe type
define('RECIPE_TYPE_PLUGIN', 'plugin');
define('RECIPE_TYPE_COMPONENT', 'component');
define('RECIPE_TYPE_PLAIN', 'plain');

// recipe archive
define('RECIPE_ARCHIVE_TARBALL', 'tarball');
define('RECIPE_ARCHIVE_FILE', 'file');

class RecipeShell extends Shell {

    public $tasks = array();
    public $ingredients;
    public $recipe;
    public $results;
    public $recipePath;

    /**
     * startup
     *
     * @return
     */
    public function startup(){
        foreach ($this->params as $key => $value) {
            switch($key) {
            case 'recipe':
                if ($value) {
                    $this->recipePath = array_shift($this->args);
                }
                break;
            case 'help':
                $this->help();
                break;
            }
        }

        if($this->recipePath) {
            if (preg_match('/^http/', $this->recipePath)) {
                $url = $this->recipePath;
                $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . TMP . 'myrecipe.php;';
                exec($cmd);
                require TMP . 'myrecipe.php';
            } else {
                require $this->recipePath;
            }
        }

        if(!isset($ingredients)) {
            $url = 'https://raw.github.com/k1LoW/recipe/master/ingredients.php';
            $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . TMP . 'ingredients.php;';
            exec($cmd);
            require TMP . 'ingredients.php';
        }
        $this->ingredients = $ingredients;

        if (isset($recipe)) {
            $this->recipe = $recipe;
        }

        parent::startup();
    }

    /**
     * _welcome
     *
     */
    protected function _welcome(){
        $this->hr();
        $this->out();
        $this->out(__d('cake_console', '<info>recipe - CakePHP CLI Package Installer - </info>'));
        $this->out();
        $this->hr();
    }

    /**
     * main
     *
     * @return
     */
    public function main() {
        if (!empty($this->recipe)) {
            $this->out(__d('cake_console', '<info>recipe install start</info>'));
            foreach ($this->recipe as $key => $value) {
                if (is_numeric($key)) {
                    $this->install($value);
                } else {
                    if (isset($this->ingredients[$key])) {
                        $this->ingredients[$key] = Set::merge($this->ingredients[$key], $value);
                    }
                    $this->install($key);
                }
            }
            $this->hr();
            $this->out(__d('cake_console', '<info>recipe install complete.</info>'));
            $this->hr();
            $this->_stop();
        }

        $this->out(__d('cake_console', '[S]earch Package'));
        $this->out(__d('cake_console', '[Q]uit'));

        $choice = strtoupper($this->in(__d('cake_console', 'What would you like to do?'), array('S', 'Q')));
        switch ($choice) {
        case 'S':
            $this->search();
            break;
        case 'Q':
            $this->out(__d('cake_console', 'Quit.'));
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
    protected function search(){
        $response = '';
        while ($response == '') {
            $example = "search";
            $response = $this->in("Search CakePHP package\nExample: "
                                  . $example
                                  . "\n[Q]uit", null, $example);
            if (strtoupper($response) === 'Q') {
                $this->out(__d('cake_console', 'Quit.'));
                $this->_stop();
            }
        }

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
    protected function select(){
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
                $this->out(__d('cake_console', 'Quit.'));
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
    protected function choice($key){
        $this->hr();
        $this->out('Package Name:' . $this->ingredients[$key]['name']);
        $this->out('Author      :' . $this->ingredients[$key]['author']);
        $this->out('Description :' . $this->ingredients[$key]['description']);
        $this->out('URL         :' . $this->ingredients[$key]['url']);
        $this->hr();

        $choice = strtoupper($this->in(__d('cake_console', 'Install '. $this->ingredients[$key]['name'] .' ?'), array('Y', 'N', 'Q')));
        switch ($choice) {
        case 'Y':
            $this->install($key);
            $this->_stop();
            break;
        case 'N':
            break;
        case 'Q':
            $this->out(__d('cake_console', 'Quit.'));
            $this->_stop();
        default:
            $this->out(__d('cake_console', 'You have made an invalid selection. Please choose a command to execute by entering Y, N or Q.'));
        }
    }

    /**
     * install
     *
     */
    protected function install($key){
        if (!isset($this->ingredients[$key])) {
            $this->out(__d('cake_console', '<error>Can not find package.</error>'));
            return;
        }
        $this->hr();
        $this->out(__d('cake_console', '<comment>Installing ' . $this->ingredients[$key]['name'] . ' ...</comment>'));
        $archive = $this->ingredients[$key]['archive'];

        switch ($archive) {
        case RECIPE_ARCHIVE_TARBALL:
            $this->__tarball($key);
            break;
        case RECIPE_ARCHIVE_FILE:
        default:
            $this->__file($key);
            break;
        }
        $this->out(__d('cake_console', '<comment>Install ' . $this->ingredients[$key]['name'] . ' complete.</comment>'));
        $this->out();
    }

    /**
     * __tarball
     *
     */
    private function __tarball($key){
        $name = $this->ingredients[$key]['name'];
        $url = $this->ingredients[$key]['url'];
        $type = $this->ingredients[$key]['type'];
        $archive = $this->ingredients[$key]['archive'];

        switch($type) {
        case RECIPE_TYPE_PLUGIN:
            $installDir = empty($this->ingredients[$key]['installDir']) ? APP . DS . 'Plugin' . DS : $this->ingredients[$key]['installDir'];
            $fileName = 'temp.tar.gz';
            $pluginName = $name;
            $tarballName = $this->ingredients[$key]['tarballName'];

            if (file_exists($installDir . $pluginName)) {
                unlink($installDir . $pluginName);
            }

            $cmd = 'cd ' . $installDir . ';wget ' . $url . ' --no-check-certificate -O ' . $fileName . ';tar zxvf ' . $fileName . ';mv ' . $tarballName . ' ' . $pluginName . ';';
            exec($cmd);
            unlink($installDir . $fileName);
            break;
        case RECIPE_TYPE_PLAIN:
        default:
            $installDir = empty($this->ingredients[$key]['installDir']) ? '' : $this->ingredients[$key]['installDir'];
            if (empty($installDir)) {
                $this->out(__d('cake_console', '<error>Invalid installDir option.</error>'));
                return;
            }
            $fileName = 'temp.tar.gz';
            $pluginName = $name;
            $tarballName = $this->ingredients[$key]['tarballName'];

            if (file_exists($installDir . $pluginName)) {
                unlink($installDir . $pluginName);
            }

            $cmd = 'cd ' . $installDir . ';wget ' . $url . ' --no-check-certificate -O ' . $fileName . ';tar zxvf ' . $fileName . ';mv ' . $tarballName . ' ' . $pluginName . ';';
            exec($cmd);
            unlink($installDir . $fileName);
            break;
        }
    }

    /**
     * __file
     *
     */
    private function __file($key){
        $name = $this->ingredients[$key]['name'];
        $url = $this->ingredients[$key]['url'];
        $type = $this->ingredients[$key]['type'];
        $archive = $this->ingredients[$key]['archive'];

        switch($type) {
        case RECIPE_TYPE_COMPONENT:
            $installDir = empty($this->ingredients[$key]['installDir']) ? APP . DS . 'Controller/Component' . DS : $this->ingredients[$key]['installDir'];
            $filePath = $installDir . $name . (preg_match('/\.php$/', $name) ? '' : '.php');
            $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . $filePath;
            exec($cmd);
            break;
        case RECIPE_TYPE_PLAIN:
        default:
            $installDir = empty($this->ingredients[$key]['installDir']) ? '' : $this->ingredients[$key]['installDir'];
            if (empty($installDir)) {
                $this->out(__d('cake_console', '<error>Invalid installDir option.</error>'));
                return;
            }
            $filePath = $installDir . $name . (preg_match('/\.php$/', $name) ? '' : '.php');
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
        return $parser;
    }


    /**
     * help
     *
     */
    public function help() {
    }
}