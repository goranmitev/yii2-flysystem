<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace creocoder\flysystem;

use League\Flysystem\Adapter\Ftp;
use yii\base\InvalidConfigException;

/**
 * FtpFilesystem
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class FtpFilesystem extends Filesystem
{
    /**
     * @var string
     */
    public $host;
    /**
     * @var integer
     */
    public $port;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $root;
    /**
     * @var boolean
     */
    public $passive;
    /**
     * @var boolean
     */
    public $ssl;
    /**
     * @var integer
     */
    public $timeout;
    /**
     * @var integer
     */
    public $permPrivate;
    /**
     * @var integer
     */
    public $permPublic;
    /**
     * @var integer
     */
    public $transferMode;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->host === null) {
            throw new InvalidConfigException('The "host" property must be set.');
        }

        if ($this->root !== null) {
            $this->root = Yii::getAlias($this->root);
        }

        parent::init();
    }

    /**
     * @return Ftp
     */
    protected function prepareAdapter()
    {
        $config = [];

        foreach ([
            'host',
            'port',
            'username',
            'password',
            'root',
            'passive',
            'ssl',
            'timeout',
            'permPrivate',
            'permPublic',
            'transferMode',
        ] as $name) {
            if ($this->$name !== null) {
                $config[$name] = $this->$name;
            }
        }

        return new Ftp($config);
    }
}
