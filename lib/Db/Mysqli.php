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
   //�������ݿ�
   private function db_connect(){
    $this->conn=mysqli_connect($this->host.':'.$this->port,$this->user,$this->pass);
    if(!$this->conn){
      echo "���ݿ�����ʧ��<br>";
      echo "�������".mysqli_errno($this->conn)."<br>";
      echo "������Ϣ".mysqli_error($this->conn)."<br>";
      exit;
    }
   }
   //�����ַ���
    private function db_charset(){
     mysqli_query($this->conn,"set names {$this->charset}");
    }
    //ѡ�����ݿ�
   private function db_usedb(){
     mysqli_query($this->conn,"use {$this->db}");
   }
   
   //���õľ�̬����
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
    //ִ��sql���ķ���
    public function query($sql){
     $res=mysqli_query($this->conn,$sql);
     if(!$res){
      echo "sql���ִ��ʧ��<br>";
      echo "���������".mysqli_errno($this->conn)."<br>";
      echo "������Ϣ��".mysqli_error($this->conn)."<br>";
     }
     return $res;
   }
   
   
   /**
    * ������һ����¼id
    * @author bin
    */
    public function getInsertid(){
     return mysqli_insert_id($this->conn);
    }
    
   /**
    * ��ѯĳ���ֶ�
    * @param
    * @author bin
    * @return string or int
    */
    public function getOne($sql){
     $query=$this->query($sql);
      return mysqli_free_result($query);
    }
    
    /**
     * ��ȡһ�м�¼,return array һά����
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
    * ��ȡһ����¼,ǰ������ͨ����Դ��ȡһ����¼
    */
    public function getFormSource($query,$type="assoc"){
    if(!in_array($type,array("assoc","array","row")))
    {
      die("mysqli_query error");
    }
    $funcname="mysqli_fetch_".$type;
    return $funcname($query);
    }
    
    
    //��ȡ�������ݣ���ά����
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