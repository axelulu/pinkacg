<?php

//引入空间
namespace core;

use \PDO,\PDOException,\PDOStatement;

//创建数据库操作文件
class Dao{
    private $pdo;

    //初始化构造方法
    public function __construct($info = array()){
        $host = $info['host'] ?? 'localhost';
        $port = $info['port'] ?? '3306';
        $user = $info['user'] ?? 'root';
        $pass = $info['pass'] ?? 'root';
        $charset = $info['charset'] ?? 'utf8';
        $dbname = $info['dbname'] ?? 'pinkacg';
        $drivers[PDO::ATTR_ERRMODE] = $drivers[PDO::ATTR_ERRMODE] ?? PDO::ERRMODE_EXCEPTION;

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";
        //连接数据库错误抓取
        try {
            $this->pdo = @new PDO($dsn,$user,$pass,$drivers);
        }catch(PDOException $e){
            //错误处理
            echo '数据库连接失败！<br/>';
            echo '错误文件为：' . $e->getFile() . '<br/>';
            echo '错误行号为：' . $e->getLine() . '<br/>';
            echo '错误描述为：' . $e->getMessage();
            die();
        }
        
        //设置mysql字符集错误抓取
        try {
            $sql = "set names {$charset}";
            $this->pdo->exec($sql);
        }catch(PDOException $e){
            //错误处理
            $this->my_exception($e);
        }
    }

    //封装错误处理方法
    private function my_exception($e){
        echo '数据库执行失败！<br/>';
        echo '错误文件为：' . $e->getFile() . '<br/>';
        echo '错误行号为：' . $e->getLine() . '<br/>';
        echo '错误描述为：' . $e->getMessage();
        die();
    }

    /*
     * 封装改数据库操作
     * $sql string 数据库语言
    */
    public function DaoExec($sql){
        try {
            //返回是否成功
            return $this->pdo->query($sql);
        }catch(PDOException $e){
            //错误处理
            $this->my_exception($e);
        }
    }

    //封装获取自增长方法
    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }

    /*
     * 封装查询方法
     * $sql string 数据库语言
     * $all bool 只允许输入true与false，true代表输出全部，false表示输出一条
    */
    public function DaoQuery($sql,$all = true,$fetch_mode = PDO::FETCH_ASSOC){
        try {
            $stmt = $this->pdo->query($sql);
            $result = $stmt->setFetchMode($fetch_mode);
            if(!$result){
                throw new PDOException('输出方式输入错误！');
            }
            if($all === true){
                return $stmt->fetchALL();
            }elseif($all === false){
                return $stmt->fetch();
            }else{
                throw new PDOException('输出模式输入错误！');
            }
        }catch(PDOException $e){
            //错误处理
            $this->my_exception($e);
        }
    }

    public function DaoQueryPost($slug,$type,$numS,$numL){
        try {
            $pre_sql = 'select * from pink_posts where post_menu = :slug order by ' . $type . ' desc limit ' . $numS . ',' . $numL . ';';
            $stmt = $this->pdo->prepare($pre_sql);
            if(!$stmt) throw new PDOException('预处理指令执行失败！');
            $stmt->bindParam(':slug',$slug,PDO::PARAM_STR, 12);		//必须是传递变量
            $res = $stmt->execute();
            if(!$res) throw new PDOException('预处理执行失败！');
            //如果是查询，想要得到预处理执行的结果，还需要使用PDOStatement::fetch()方法进行数据解析
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            //错误处理
            $this->my_exception($e);
        }
    }
}

?>