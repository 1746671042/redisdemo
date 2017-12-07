<?php
class redisDB{
    //获取redis实例化对象
    private $redis;
    //单利模式
    public static  $link;
    public static function getInstance(){
        if(empty(self::$link)){
            self::$link = new self();
        }
        return self::$link;
    }
    
    public function __construct() {
        $this->redis = new Redis();
        //redis连接
        $this->redis->connect("127.0.0.1",6379);
    }
    
    public function getRedis(){
        return $this->redis;
    }


    /*************      字符串类型      *************/
   
    /**
     * 设置字符串类型
     * @param string $key 键
     * @param string $value 值
     * @param int $time 有效期  0:永久
     */
    public function stringSet($key,$value,$time=0){
        if($time ==0){
            $result =  $this->redis->set($key,$value);
        }else{
            $result = $this->redis_>set($key,$time,$value);
        }
    }
    /**
     * 获取字符串类型
     * @param string $key 键
     * @param string $value 值
     * @param int $time 有效期  0:永久
     */
    public function stringGet($key){
        return $this->redis->del($key);
    }
      /**
     * 修改字符串类型
     * @param string $key 键
     * @param string $value 值
     * @param int $time 有效期  0:永久
     */
    public function stringUpdate($key){
        return $this->redis->update($key);
    }
      /**
     * 删除字符串类型
     * @param string $key 键
     * @param string $value 值
     * @param int $time 有效期  0:永久
     */
    public function stringDel($key){
        return $this->redis->del($key);
    }
    /**
     * 判断是否存在
     */
    public function stringExists($key){
        return $this->redis->exists($key);
    }
}

$redis = new redisDB();
$redis->stringSet("name");