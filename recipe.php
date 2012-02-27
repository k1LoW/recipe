<?php

function searcyShellDispatcher($dir) {
    echo 'Searching ' . $dir . " ...\n";
    if (file_exists($dir . '/lib/Cake/Console/' . 'ShellDispatcher.php')) {
        require_once($dir . '/lib/Cake/Console/' . 'ShellDispatcher.php');
        echo 'Search OK. require_once ' . $dir . '/lib/Cake/Console/' . 'ShellDispatcher.php' . "\n";
        return true;
    }
    $parentDir = dirname($dir);
    if ($parentDir === '/') {
        throw new Exception('Can not search ShellDispatcher.php');
    }
    return searcyShellDispatcher($parentDir);
}

$currentDir = dirname(__FILE__);
searcyShellDispatcher($currentDir);

class RecipeShellDispatcher extends ShellDispatcher {

    public static function run($argv) {
        $dispatcher = new RecipeShellDispatcher($argv);
        $dispatcher->_stop($dispatcher->dispatch() === false ? 1 : 0);
    }

    public function dispatch() {

        $Shell = $this->_getShellFromUrl();

        $command = null;
        if (isset($this->args[0])) {
            $command = $this->args[0];
        }

        if ($Shell instanceof Shell) {
            $Shell->initialize();
            $Shell->loadTasks();
            return $Shell->runCommand($command, $this->args);
        }
        $methods = array_diff(get_class_methods($Shell), get_class_methods('Shell'));
        $added = in_array($command, $methods);
        $private = $command[0] == '_' && method_exists($Shell, $command);

        if (!$private) {
            if ($added) {
                $this->shiftArgs();
                $Shell->startup();
                return $Shell->{$command}();
            }
            if (method_exists($Shell, 'main')) {
                $Shell->startup();
                return $Shell->main();
            }
        }
        throw new MissingShellMethodException(array('shell' => $shell, 'method' => $arg));
    }

    protected function _getShellFromUrl() {
        App::uses('Shell', 'Console');
        App::uses('AppShell', 'Console/Command');

        $url = 'https://raw.github.com/k1LoW/recipe/master/RecipeShell.php';
        $cmd = 'wget ' . $url . ' --no-check-certificate -O ' . TMP . 'RecipeShell.php;';
        exec($cmd);
        require TMP . 'RecipeShell.php';

        $Shell = new RecipeShell();
        return $Shell;
    }
}

return RecipeShellDispatcher::run($argv);