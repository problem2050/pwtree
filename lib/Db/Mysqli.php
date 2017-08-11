<?php
class Db_Mysqli {
 
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
    $this->pass = $config['password'] ? $config['password'] : '';
    $this->db = $config['dbname'] ? $config['dbname'] : 'pwtree';
    //$this->charset=isset($arr['charset']) ? $arr['charset'] : 'utf8';
    $this->conn=null;
    
    $this->conn=mysqli_connect($this->host,$this->user,$this->pass,$this->db);
    if(!$this->conn){
      SeasLog::log(SEASLOG_ERROR,"数据库连接失败");
      SeasLog::log(SEASLOG_ERROR,"错误编码:".mysqli_errno($this->conn));
      SeasLog::log("错误信息".mysqli_error($this->conn));
      exit;
    }
	
	if(!$this->conn->set_charset("utf8")){		
		SeasLog::log(SEASLOG_ERROR,"Error loading character set utf8: " .$this->conn->error);
     } else {
	     SeasLog::log(SEASLOG_ERROR,"Current character set:".$this->conn->character_set_name());
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
   	                    
   	 self::$instance[$dbname] = new Db_Mysqli($db_conf);   	      
   }
    return self::$instance[$dbname];
  }

  public function queryOne($sql){
  	
     $result =$this->conn->query($sql);    
     $row = $result->fetch_array(MYSQLI_ASSOC);   
     $result->close();
       
     return $row;
   }
   
  public function query($sql){
  	
    $result = $this->conn->query($sql);
    if($result===True){
     	return True;
    }else{
    	$rows  = $result->num_rows;
      $result->close();       
      return $rows;     
   }
 }
  
  public function queryfetch($sql){
  	 $datalist = [];
     $result=$this->conn->query($sql);
     if($result){
     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
         $datalist[] = $row;
      }
      
      $result->close();
       }
     return $datalist;
   }
         
		
 public function execPrepared($sql, array $args)
    {
    	 
        $stmt   = $this->conn->prepare($sql);
        
        $params = [];
        $types  = array_reduce($args, function ($string, &$arg) use (&$params) {
            $params[] = &$arg;
            if (is_float($arg))         $string .= 'd';
            elseif (is_integer($arg))   $string .= 'i';
            elseif (is_string($arg))    $string .= 's';
            else                        $string .= 'b';
            return $string;
        }, '');
        array_unshift($params, $types);

        call_user_func_array([$stmt, 'bind_param'], $params);        
        $result = $stmt->execute() ;
         
        $stmt->close();
       
       return $result;
    
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
        
    
    public function setCommit($isbool)
    {
    	$this->conn->autocommit($isbool);
    }
     
    function __destruct(){
        $this->conn->close();
    }
     
}
?>
