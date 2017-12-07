<?php

$redis = new Redis();
$redis->connect("127.0.0.1", 6379);
$redis->set("name", "zhangsan");

var_dump($redis->get("name"));

class redis {

    private $_default_config_path = "phpstudy/www/redis/64bit";
    // redis实例对象
    private $_redis;
    // redis服务器地址
    private $_host = '';
    // redis服务器端口
    private $_port = 6379;

    public function __construct(array $conf = array()) {
        $this->set_conf($conf);
        $this->reconnect(true);
    }
    
    /**
     * 设置redis配置
     * 执行前，配置会被重置为[host='', port='6379']
     *
     * @access public
     * @param array $conf 配置文件集合, 包含参数：
     *              string $host 服务器地址
     *              string $port 服务器端口
     * @return void
     */

    public function set_conf(array $conf = array()) {
        if (empty($conf)) {
            $conf = load_config($this->_default_config_path);
            if (!is_array($conf) or empty($conf)) {
                to_log(MAIN_LOG_ERROR, '', __CLASS__ . ':' . __FUNCTION__ . ': 默认配置为空');
                return;
            }
            
            $this->_host = "";
            $this->_path = 6379;
            isset($conf["host"])and $this->_host =$conf['host'];
            isset($conf["path"]) and $this->_port = intval($conf['part']);
            
        }
    }
    
     /**
     * 重新连接redis
     *
     * @access public
     * @param boolean $is_new 是否必须重新连接
     * @return boolean
     */
    public function reconnect($is_new=false) {
        $ret = false;
        if ($is_new) {
            $ret = $this -> _connect();
            return $ret;
        }

        $check = $this -> _is_connected();
        if (!$check) {
            $ret = $this -> _connect();
        }

        return $ret;
    }
    
    

}
  