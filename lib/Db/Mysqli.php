<?php
class ConnMysqli{
 
  private static $instance=false;
  private $host;
  private $port;
  private $user;
  private $pass;
  private $db;
  private $charset;
  private $conn;
  
  
  private function __construct($config=array()){
    $this->host = $config['host'] ? $config['host'] : 'localhost';
    $this->port = $config['port'] ? $config['port'] : '3306';
    $this->user = $config['user'] ? $config['user'] : 'root';
    $this->pass = $config['password'] ? $config['password'] : '1';
    $this->db = $config['dbname'] ? $config['dbname'] : 'pwtree';
    //$this->charset=isset($arr['charset']) ? $arr['charset'] : 'utf8';
       
    $this->conn=mysqli_connect($this->host,$this->user,$this->pass,$this->db);
    if(!$this->conn){
      SeasLog::log(SEASLOG_ERROR,"数据库连接失败");
      SeasLog::log(SEASLOG_ERROR,"错误编码".mysqli_errno($this->conn));
      SeasLog::log("错误信息".mysqli_error($this->conn));
      exit;
    }
    
   }
    
   
   //公用的静态方法
   public static function getIntance($dbname="pwtree"){
   	
   	if (!isset(self::$instance[$dbname])){   		
   		 $confinfo = $_SERVER["DB_{$dbname}"];   	
   	 
   	   //$constr = "127.0.0.1/user/password/dbname/3306";
   	   $conf = explode("/", $confinfo);
   	   $c = __CLASS__;
   	   $db_conf = array('host'=>$conf[0],
   	                    'user'=>$conf[1],
   	                    'password'=>$conf[2],
   	                    'dbname'=>$conf[3],
   	                    'port'=>$conf[4]);
   	                    
   	 self::$instance[$dbname] = new ConnMysqli($db_conf);   	      
   }
    return self::$instance[$dbname];
  }
    //执行sql语句的方法
  public function queryOne($sql){
     $result=$this->conn->query($sql, MYSQLI_USE_RESULT);
       while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      
      }
     //$row = $res-> mysqli_fetch_all(MYSQLI_ASSOC); 
     //return $row;
   }
   
   
   /**
    * 获得最后一条记录id
    * @author bin
    */
    public function getInsertid(){
     return mysqli_insert_id($this->conn);
    }
    
   /**
    * 查询某个字段
    * @param
    * @author bin
    * @return string or int
    */
    public function getOne($sql){
     $query=$this->query($sql);
      return mysqli_free_result($query);
    }
    
    /**
     * 获取一行记录,return array 一维数组
     */    
    public function getRow($sql,$type="assoc"){
     $query=$this->query($sql);
     if(!in_array($type,array("assoc",'array',"row"))){
       die("mysqli_query error");
     }
     
     $funcname="mysqli_fetch_".$type;
     
     return $funcname($query);
    }
    
    /**
    * @author bin
    * 获取一条记录,前置条件通过资源获取一条记录
    */
    public function getFormSource($query,$type="assoc"){
    if(!in_array($type,array("assoc","array","row")))
    {
      die("mysqli_query error");
    }
    $funcname="mysqli_fetch_".$type;
    return $funcname($query);
    }
    
    
    public function setCommit($isbool)
    {
    	$this->conn->autocommit($isbool);
    }
     
     
     
}
?>