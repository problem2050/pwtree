<?php


$merid = 100001;

GLOBAL $merid;

function getPageHtml($allcnt,$page,$pagesize){

  $pagehtml = '';

  $maxpage = (int)($allcnt / $pagesize) + 1;

  $pagehtml = "<li class=\"prev \" ><a href=\"?page=1&pagesize=".$pagesize."\"><i class=\"fa fa-angle-left\"></i></a></li>";

  for($i=1;$i<= $maxpage;$i++)
  {

    if ($page==$i)
    {
      $pagehtml .="<li class=\"active\" ><a href=\"?page=".$i."&pagesize=".$pagesize."\">".$i."</a></li>";
    }else{

      $pagehtml .="<li><a href=\"?page=".$i."&pagesize=".$pagesize."\">".$i."</a></li>";
     }
  }

   $pagehtml .= "<li class=\"next\" ><a href=\"?page=".$maxpage."&pagesize=".$pagesize."\"><i class=\"fa fa-angle-right\"></i></a></li>";

  return $pagehtml;
}
