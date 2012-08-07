<?php
App::uses('Shell', 'Console');
App::uses('Set', 'Utility');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

// recipe type
define('RECIPE_TYPE_PLUGIN', 'plugin');
define('RECIPE_TYPE_COMPONENT', 'component');
define('RECIPE_TYPE_BEHAVIOR', 'behavior');
define('RECIPE_TYPE_PLAIN', 'plain');

// recipe archive
define('RECIPE_ARCHIVE_TARBALL', 'tarball');
define('RECIPE_ARCHIVE_ZIP', 'zip');
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

        $original = array();
        if(isset($ingredients)) {
            $original = $ingredients;
        }
        $url = 'https://raw.github.com/k1LoW/recipe/master/ingredients.php';
        $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . TMP . 'ingredients.php;';
        exec($cmd);
        require TMP . 'ingredients.php';
        $this->ingredients = array();
        foreach ($ingredients as $key => $value) {
            $this->ingredients[strtolower($key)] = $value;
        }
        foreach ($original as $key => $value) {
            $this->ingredients[strtolower($key)] = $value;
        }

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
                    $value = strtolower($value);
                    $this->install($value);
                } else {
                    $key = strtolower($key);
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
            $name = $value['name'];
            if (!empty($value['displayName'])) {
                $name = $value['displayName'];
            }
            $this->out($key . ':' . $name);
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
        case RECIPE_ARCHIVE_ZIP:
            $this->__zip($key);
            break;
        case RECIPE_ARCHIVE_FILE:
        default:
            $this->__file($key);
            break;
        }

        if (isset($this->ingredients[$key]['require'])) {
            $require = $this->ingredients[$key]['require'];
            foreach ((array)$require as $value) {
                $this->install(strtolower($value));
            }
        }

        if(isset($this->ingredients[$key]['after'])) {
            call_user_func_array($this->ingredients[$key]['after'], array());
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

            if (!$this->__checkAndRemoveDir($installDir . $pluginName)) {
                return;
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

            if (!$this->__checkAndRemoveDir($installDir . $pluginName)) {
                return;
            }

            $cmd = 'cd ' . $installDir . ';wget ' . $url . ' --no-check-certificate -O ' . $fileName . ';tar zxvf ' . $fileName . ';mv ' . $tarballName . ' ' . $pluginName . ';';
            exec($cmd);
            unlink($installDir . $fileName);
            break;
        }
    }

    /**
     * __zip
     *
     */
    private function __zip($key){
        $name = $this->ingredients[$key]['name'];
        $url = $this->ingredients[$key]['url'];
        $type = $this->ingredients[$key]['type'];
        $archive = $this->ingredients[$key]['archive'];

        switch($type) {
        case RECIPE_TYPE_PLUGIN:
            $installDir = empty($this->ingredients[$key]['installDir']) ? APP . DS . 'Plugin' . DS : $this->ingredients[$key]['installDir'];
            $fileName = 'temp.zip';
            $pluginName = $name;
            $tarballName = $this->ingredients[$key]['tarballName'];

            if (!$this->__checkAndRemoveDir($installDir . $pluginName)) {
                return;
            }

            $cmd = 'cd ' . $installDir . ';wget ' . $url . ' --no-check-certificate -O ' . $fileName;
            exec($cmd);
            $zip = new ZipArchive;
            if (!$zip->open($installDir . $fileName)) {
                $this->out(__d('cake_console', '<error>Invalid zip archive.</error>'));
                return;
            }
            $zip->extractTo(TMP . $name);
            $zip->close();
            if (count(glob(TMP . $name . '/*')) === 1) {
                $cmd = 'mv ' . TMP . $name . DS . '* ' . $installDir;
                exec($cmd);
                rmdir(TMP . $name);
            } else {
                $cmd = 'mv ' . TMP . $name . ' ' . $installDir . $name;
                exec($cmd);
            }
            unlink($installDir . $fileName);
            break;
        case RECIPE_TYPE_PLAIN:
        default:
            $installDir = empty($this->ingredients[$key]['installDir']) ? '' : $this->ingredients[$key]['installDir'];
            if (empty($installDir)) {
                $this->out(__d('cake_console', '<error>Invalid installDir option.</error>'));
                return;
            }
            $fileName = 'temp.zip';
            $pluginName = $name;

            if (!$this->__checkAndRemoveDir($installDir . $pluginName)) {
                return;
            }

            $cmd = 'cd ' . $installDir . ';wget ' . $url . ' --no-check-certificate -O ' . $fileName;
            exec($cmd);
            $zip = new ZipArchive;
            if (!$zip->open($installDir . $fileName)) {
                $this->out(__d('cake_console', '<error>Invalid zip archive.</error>'));
                return;
            }
            $zip->extractTo(TMP . $name);
            $zip->close();
            if (count(glob(TMP . $name . '/*')) === 1) {
                $cmd = 'mv ' . TMP . $name . DS . '* ' . $installDir;
                exec($cmd);
                rmdir(TMP . $name);
            } else {
                $cmd = 'mv ' . TMP . $name . ' ' . $installDir . $name;
                exec($cmd);
            }
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

            break;
        case RECIPE_TYPE_BEHAVIOR:
            $installDir = empty($this->ingredients[$key]['installDir']) ? APP . DS . 'Model/Behavior' . DS : $this->ingredients[$key]['installDir'];
            $filePath = $installDir . $name . (preg_match('/\.php$/', $name) ? '' : '.php');

            break;
        case RECIPE_TYPE_PLAIN:
        default:
            $installDir = empty($this->ingredients[$key]['installDir']) ? '' : $this->ingredients[$key]['installDir'];
            if (empty($installDir)) {
                $this->out(__d('cake_console', '<error>Invalid installDir option.</error>'));
                return;
            }
            $filePath = $installDir . $name . (preg_match('/\.php$/', $name) ? '' : '.php');

            break;
        }

        if (!$this->__checkFile($filePath)) {
            return;
        }

        $cmd = 'mkdir -p ' . dirname($filePath);
        exec($cmd);

        file_put_contents($filePath, file_get_contents($url));
    }

    /**
     * __checkAndRemoveDir
     *
     * @param $dirPath
     */
    private function __checkAndRemoveDir($dirPath){
        if (file_exists($dirPath) && is_dir($dirPath)) {
            $choice = strtoupper($this->in(__d('cake_console', $dirPath . ' already exists, overwrite?'), array('Y', 'N')));
            switch ($choice) {
            case 'Y':
                break;
            case 'N':
                $this->out(__d('cake_console', 'Install ' . $dirPath . ' canceled.'));
                return false;
                break;
            }
            $folder = new Folder();
            if(!$folder->delete($dirPath)) {
                $this->out(__d('cake_console', implode("\n", $folder->errors())));
            }
        }
        return true;
    }

    /**
     * __checkFile
     *
     * @param $filePath
     */
    private function __checkFile($filePath){
        if (file_exists($filePath) && is_file($filePath)) {
            $choice = strtoupper($this->in(__d('cake_console', $filePath . ' already exists, overwrite?'), array('Y', 'N')));
            switch ($choice) {
            case 'Y':
                return true;
                break;
            case 'N':
                $this->out(__d('cake_console', 'Install ' . $this->ingredients[$key]['name'] . ' canceled.'));
                return false;
                break;
            }
        }
        return true;
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