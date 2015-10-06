<?php
/**
 * Configuration.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 11:25 AM
 */

namespace PrimeTwo\Framework;


class Configuration
{
    private $configPath = '';
    private $configuration = array();

    /**
     * Construct the configuration class
     */
    public function __construct()
    {
        $this->setConfigPath(ROOT.'config/');
        $files = preg_grep('/^([^.])/', scandir($this->getConfigPath()));
        foreach($files as $file)
            $this->pushConfiguration($file);
    }

    public function get($configName)
    {
        $config = $this->getConfiguration();

        return $config[$configName];
    }

    /**
     * @return string
     */
    public function getConfigPath()
    {
        return $this->configPath;
    }

    /**
     * @param string $configPath
     */
    public function setConfigPath($configPath)
    {
        $this->configPath = $configPath;
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Push file to the configuration array
     *
     * @param string $configurationFile
     * @return array $config
     */
    public function pushConfiguration($configurationFile)
    {
        $config = $this->getConfiguration();
        $name = str_replace('.php','', $configurationFile);
        $config[$name]  = $this->fetchConfig($configurationFile);
        $this->setConfiguration($config);

        return $config;
    }

    /**
     * Fetch a config file into an array
     *
     * @param $configurationFile
     * @return bool|mixed
     */
    public function fetchConfig($configurationFile)
    {
        if(is_file($this->getConfigPath().$configurationFile))
          return include $this->getConfigPath().$configurationFile;
        return false;
    }

    /**
     * @param array $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }
}