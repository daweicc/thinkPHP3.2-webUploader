<?php
/**
 * Created by PhpStorm.
 * User: dawei
 * Date: 2018/3/22
 * Time: 18:44
 */

namespace Think\Session\Driver;

//SessionHandlerInterface是PHP5.4以上才支持
//[]用来定义数组，PHP5.4以上才支持
//class Redis implements \SessionHandlerInterface
class Redis
{
    protected $handler = null;
//    protected $config  = [];
    protected $config  = array();


    public function __construct($config = array())
    {
        $config['host']           = C('REDIS_HOST')       ? C('REDIS_HOST')       :  '127.0.0.1'; //redis服务器ip，多台用逗号隔开；读写分离开启时，第一台负责写，其它[随机]负责读；
        $config['port']           = C('REDIS_PORT')       ? C('REDIS_PORT')       :  6379       ; //端口号
        $config['password']       = C('REDIS_AUTH')       ? C('REDIS_AUTH')       :  ''         ; //AUTH认证密码
        $config['expire']         = C('SESSION_EXPIRE')   ? C('SESSION_EXPIRE')   :  3600       ; //session有效时间
        $config['timeout']        = C('REDIS_TIMEOUT')    ? C('REDIS_TIMEOUT')    :  0          ; //连接超时时间
        $config['persistent']     = C('REDIS_PERSISTENT') ? C('REDIS_PERSISTENT') :  true       ; //是否长连接 false=短连接
        $config['session_prefix'] = C('SESSION_PREFIX')   ? C('SESSION_PREFIX')   :  ''         ; //session前缀

        $this->config = array_merge($this->config, $config);
    }


    /**
     * 打开Session
     * @access public
     * @param string $savePath
     * @param mixed  $sessName
     * @return bool
     * @throws Exception
     */
    public function open($savePath, $sessName)
    {
        // 检测php环境
        if (!extension_loaded('redis')) {
            // throw new Exception('not support:redis');
            echo 'not support:redis';
        }

        $this->handler = new \Redis;

        // 建立连接
        $func = $this->config['persistent'] ? 'pconnect' : 'connect';
        $this->handler->$func($this->config['host'], $this->config['port'], $this->config['timeout']);

//        if (empty($this->handler)) {
//            //redis服务器连接失败
//        }


        if ('' != $this->config['password']) {
            $this->handler->auth($this->config['password']);
        }

        if (0 != $this->config['select']) {
            $this->handler->select($this->config['select']);
        }

//        var_dump($this->handler->get('array_category'));die;
        return true;
    }


    /**
     * 关闭Session
     * @access public
     */
    public function close()
    {
        $this->gc(ini_get('session.gc_maxlifetime'));
        $this->handler->close();
        $this->handler = null;
        return true;
    }
    /**
     * 读取Session
     * @access public
     * @param string $sessID
     * @return string
     */
    public function read($sessID)
    {
        return (string) $this->handler->get($this->config['session_prefix'] . $sessID);
    }
    /**
     * 写入Session
     * @access public
     * @param string $sessID
     * @param String $sessData
     * @return bool
     */
    public function write($sessID, $sessData)
    {
        if ($this->config['expire'] > 0) {
            return $this->handler->setex($this->config['session_prefix'] . $sessID, $this->config['expire'], $sessData);
        } else {
            return $this->handler->set($this->config['session_prefix'] . $sessID, $sessData);
        }
    }
    /**
     * 删除Session
     * @access public
     * @param string $sessID
     * @return bool
     */
    public function destroy($sessID)
    {
        return $this->handler->delete($this->config['session_prefix'] . $sessID) > 0;
    }
    /**
     * Session 垃圾回收
     * @access public
     * @param string $sessMaxLifeTime
     * @return bool
     */
    public function gc($sessMaxLifeTime)
    {
        return true;
    }

}