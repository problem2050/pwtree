<?php
class ConnectMysqli{
 
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
    $this->pass = $config['pass'] ? $config['pass'] : '';
    $this->db = $config['db'] ? $config['db'] : 'pwtree';
    //$this->charset=isset($arr['charset']) ? $arr['charset'] : 'utf8';
    
    $this->db_connect();
   
    $this->db_usedb();
   
    //$this->db_charset();
   }
   //连接数据库
   private function db_connect(){
    $this->conn=mysqli_connect($this->host.':'.$this->port,$this->user,$this->pass);
    if(!$this->conn){
      echo "数据库连接失败<br>";
      echo "错误编码".mysqli_errno($this->conn)."<br>";
      echo "错误信息".mysqli_error($this->conn)."<br>";
      exit;
    }
   }
   //设置字符集
    private function db_charset(){
     mysqli_query($this->conn,"set names {$this->charset}");
    }
    //选择数据库
   private function db_usedb(){
     mysqli_query($this->conn,"use {$this->db}");
   }
   
   //公用的静态方法
   public static function getIntance($dbname="pwtree"){
   	
   	if (!isset(self::$instance[$dbid])){   		
   		 $confinfo = $_SERVER["DB_{$dbname}"];   	
   	 
   	   //$constr = "127.0.0.1/user/password/dbname/3306";
   	   $conf = explode("/", $confinfo);
   	   $c = __CLASS__;
   	   $db_conf = array('host'=>$conf[0],
   	                    'user'=>$conf[1],
   	                    'password'=>$conf[2],
   	                    'dbname'=>$conf[3],
   	                    'port'=>$conf[4]);
   	 self::$instance[$dbname] = new $c($db_conf);   	      
   }
    return self::$instance[$dbname];
  }
    //执行sql语句的方法
    public function query($sql){
     $res=mysqli_query($this->conn,$sql);
     if(!$res){
      echo "sql语句执行失败<br>";
      echo "错误编码是".mysqli_errno($this->conn)."<br>";
      echo "错误信息是".mysqli_error($this->conn)."<br>";
     }
     return $res;
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
    
    
    //获取多条数据，二维数组
    public function getAll($sql){
     $query=$this->query($sql);
     $list=array();
     while ($r=$this->getFormSource($query)) {
      $list[]=$r;
     }
     return $list;
    }
     
     
}
?>