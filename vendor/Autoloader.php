<?php

/**
 * Class Autoloader
 *
 * Find and load classes.
 * Example of use:
 * Include class Autoloader in index.php your application.
 * Create object Autoloader class and run method run().
 * If you wont add custom namespace use method addCustomNamespace($namespace string, $folder string).
 */
class Autoloader
{
    /**
     * @var string $basePath It contains application path.
     */
    private $basePath;

    /**
     * Autoloader constructor.
     *
     * Set base directory application.
     *
     */
    public function __construct()
    {
        $this->basePath = dirname(__DIR__);
    }

    /**
     * This method started process autoload.
     */
    public function run()
    {
        spl_autoload_register(array($this, 'ClassLoad'));
    }

    /**
     * This method searches and connection classes.
     *
     * @param string $class contain name included classes.
     * @return string
     */
    public function ClassLoad($class)
    {
        $namespace = explode('\\', $class);
        $className = $namespace[count($namespace) - 1];
        $namespace = str_replace('\\'.$className, '', $class);
        
        $classFolder = $namespace;

        if(!empty($this->customNamenespace)) {
            foreach ($this->customNamenespace as $key => $value) {
                if ($key === $namespace) {
                    $classFolder = $value;
                    break;
                }
            }
        }

        $classPath = $this->basePath .'\\' . $classFolder . '\\' . $className . '.php';
        if(file_exists($classPath)) {
            return require_once $classPath;
        }
    }
}