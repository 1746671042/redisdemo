<?php
//header("content-Type: text/html; charset=utf-8");
header("content-Type:text/html; charset=utf-8");
class mysqlDb {

    private $localhost = "localhost";
    private $user = "root";
    private $pwd = "111444le";
    public $db;
    public $charset = "utf8";
    //结果
    public static $con;
    //错误信息
    private $error;
    public static $link;
    public $num;
    //声明单利
    public static function getIntance($db, $localhost = "localhost", $user = "root", $pwd = "111444le", $charset = "utf8") {
        if (empty(self::$link)) {
            self::$link = new self($db, $localhost, $user, $pwd, $charset);
        }
//       else{
//           $this->db = $db;
//           $this->setDB();
//       }
        return self::$link;
    }

    public function __construct($db, $localhost = "localhost", $user = "root", $pwd = "111444le", $charset = "utf8") {
        $this->db = $db;
        $this->localhost = $localhost;
        $this->user = $user;
        $this->pwd = $pwd;
        $this->charset = $charset;

        $this->connect();
        $this->charset();
    }

    //连接数据库
    public function connect() {
        self::$con = mysqli_connect($this->localhost, $this->user, $this->pwd, $this->db);
        if (!self::$con) {
            $this->error = "连接数据库失败" . mysqli_connect_errno();
        }
    }

    //校验编码
    public function charset() {
        mysqli_set_charset(self::$con, $this->charset);
    }

//    public function setDB(){
//        mysqli_select_db(self::$con, $this->db);
//    }

    public function querysql($sql) {
        if ($sql == "") {
            $this->error = "sql 语句为空";
            return false;
        }
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            $this->error = "sql语句执行失败" . mysqli_errno($this->error);
        }
        return $result;
    }

    //插入一条
    public function add($sql) {
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            $this->error = "sql语句不能为空";
        } else {
            $this->error = "插入成功！";
        }
        return $result;
    }

    //删除
    public function delete($sql) {
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            $this->error = "删除失败";
        } else {
            $this->error = "删除成功！";
        }
        return $result;
    }
     //修改
    public function update($sql) {
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            $this->error = "修改失败";
        } else {
            $this->error = "修改成功！";
        }
        return $result;
    }

    //查询一条
    public function query($sql) {
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            return array();
        }
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //查询所有
    public function queryAll($sql) {
        $result = mysqli_query(self::$con, $sql);
        if ($result == false) {
            return array();
        }
        $arr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        return $arr;
    }

    //查询所有条数
    public function queryNum($sql) {
        $result = $this->querysql($sql);
        if ($result == false) {
            $this->error = "无内容";
        } 
        $num = mysqli_num_rows($result);
        return $num;
    }

//    //查询结果
//    public function select($sql) {
//        $result = $this->querysql($sql);
//        if ($result == false) {
//            return array();
//        }
//        $arr = array();
//        while ($row = mysqli_fetch_assoc($result)) {
//            $arr[] = $row;
//        }
//        return $arr;
//    }
    //获取错误信息
    public function getError() {
        return $this->error;
    }

    //关闭数据库
    public function __destruct() {
        mysqli_close(self::$con);
    }

}

//$link = mysqlDb::getIntance("huaban");
////插入一条
//$sql = "insert into user (id,username,pwd) values (553,'张三','111444')";
//$list = $link->add($sql);
//var_dump($list);
//查询一条
//$sql = "select * from user";
//$list = $link->query($sql);
//var_dump($list);
////查询所有
//$sql = "select * from user";
//$list = $link->queryAll($sql);
//var_dump($list);
//删除
//$sql = "delete from user limit 1;";
//$list = $link->delete($sql);

////修改
//$sql = "update user set name = "李四" where id=3;";
//$list = $link->delete($sql);
//var_dump($list);
//总条数
//$sql = "select * from user;";
//$list = $link->queryNum($sql);
//echo $list;
