<?php
/**
 * 获取文件内容
 * @param string $filename
 * @param string $mode
 * @return multitype:|multitype:string
 * @author Hhb 2017-09-09
 */
function getFileContents($filename, $mode = 'r'){
    if(empty($filename) || !is_file($filename)){
        return array();
    }
    $file = fopen($filename, $mode);
    $arr = array();
    while ($data = fgets($file)){
        if(strpos(trim($data),"#") === 0){
            continue;
        }
        $temp = explode("=", trim($data));
        $arr[trim($temp[0])] = trim($temp[1]);
    }
    fclose($file);
    return $arr;
}
/**
 * 图片缩略
 * @param string $filename  图片文件路径
 * @param string $width     缩略宽
 * @param string $height    缩略高
 * @param string $path      图片保存目录路径
 * @return string           缩略图片文件路径
 */
function zoom($filename, $width, $height, $path = ''){
    $dst_w = $width;
    $dst_h = $height;
    $arr = getimagesize($filename);
    switch ($arr['mime']){
        case "image/png":
            $srcType = 'imagecreatefrompng';
            $outType = 'imagepng';
            break;
        case "image/jpg":
        case "image/jpeg":
            $srcType = 'imagecreatefromjpeg';
            $outType = 'imagejpeg';
            break;
        case "image/gif":
            $srcType = 'imagecreatefromgif';
            $outType = 'imagegif';
            break;
    }
    $src_im = $srcType($filename);
    $src_w = $arr[0];
    $src_h = $arr[1];
    $bili_w = $src_w/$dst_w;
    $bili_h = $src_h/$dst_h;
    if($src_w <= $dst_w && $src_h <= $dst_h){
        $true_w = $src_w;
        $true_h = $src_h;
        $dst_im = imagecreatetruecolor($true_w, $true_h);
    }elseif($bili_w >= $bili_h){
        $true_w = $src_w/$bili_w;
        $true_h = $src_h/$bili_w;
        $dst_im = imagecreatetruecolor($true_w, $true_h);
    }else{
        $true_w = $src_w/$bili_h;
        $true_h = $src_h/$bili_h;
        $dst_im = imagecreatetruecolor($true_w, $true_h);
    }
    imagecopyresized($dst_im, $src_im, 0, 0, 0, 0, $true_w, $true_h, $src_w, $src_h);
    $temp = explode("/", $filename);
    $temp = array_pop($temp);
    $ext = substr($temp,strrpos($temp,'.'));
    $name = substr($temp,0,strrpos($temp,'.'));
    $truePath = !empty($path)? $path."/" : '';
    if(!empty($truePath) && !is_dir($truePath)){
        mkdir($truePath,0777,true);
    }
    $newname = $truePath.$name.'_s'.$ext;
    $outType($dst_im, $newname);
    return $newname;
}
/**
 * 获取目录的内容
 * @param string $path
 * @return boolean|multitype:unknown
 */
function getDirContent($path){
    if(!is_dir($path)){
        return false;
    }
    /* $dir = opendir($path);
    $arr = array();
    while($content = readdir($dir)){
        if($content != '.' && $content != '..'){
            $arr[] = $content;
        }
    }
    closedir($dir); */
    $arr = array();
    $data = scandir($path);
    foreach ($data as $v){
        if($v != '.' && $v != '..'){
            $arr[] = $v;
        }
    }
    return $arr;
}
/**
 * TODO:起个名字
 * @param unknown $srcPath
 * @param unknown $dstPath
 * @return multitype:number
 */
function fileCopy($srcPath,$dstPath){
    $truePath = !empty($dstPath)? $dstPath."/" : '';
    if(!empty($truePath) && !is_dir($truePath)){
        mkdir($truePath,0777,true);
    }
    $data = getDirAllContents($srcPath);
    $i = $j = 0;
    foreach ($data as $v){
        if(is_file($v)){
            $i++;
            $data = file_get_contents($v);
            $temp = explode("/", $v);
            $temp = array_pop($temp);
            $ext = substr($temp,strrpos($temp,'.'));
            $name = substr($temp,0,strrpos($temp,'.'));
            $newname = $truePath.$name.'_s'.$ext;
            $re = file_put_contents($newname, $data);
            if($re){
                $j++;
            }
        }
    }
    return array('success'=>$j,'error'=>$i-$j,'total'=>$i);
}
/**
 * 获取目录的所有内容（目录及文件，包括子目录）
 * @param string $path
 * @return Ambigous <multitype:unknown , multitype:>
 */
function getDirAllContents($path){
    $arr = array();
    $arr[] = $path;
    if(is_file($path)){
    
    }else{
        if(is_dir($path)){
            $data = scandir($path);//. .. d j 3.txt
            if(!empty($data)){
                foreach ($data as $v){
                    if($v !='.' && $v!='..'){
                        $truePath = $path."/";
                        $temp = getDirAllContents($truePath.$v);
                        $arr = array_merge($arr,$temp);
                    }
                }
            }
        }
    }
    return $arr;
}
/**
 * 对密码加密
 * @param unknown $string
 * @return string
 */
function pwdMD5($string){
    return md5(sha1("#!").sha1($string."@"));//md5(sha1("#!".$string."@"));
}
function post($key = null){
    if(!empty($key)){
        $return = isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : '';
    }else{
        $return = $_POST;
    }
    return $return;
}
function get($key = null){
    if(!empty($key)){
        $return = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : '';
    }else{
        $return = $_GET;
    }
    return $return;
}
/**
 * 分页
 * @param unknown $page             当前页码
 * @param unknown $page_num         每页显示的数据条数
 * @param unknown $count_num        数据库中总的数据条数
 * @return string                   返回的分页条
 */
function fenye($page,$page_num,$count_num){
    $centerStr = "";
    //$count_page是总的页码数
    $count_page = ceil($count_num/$page_num);
    $first_page = 1;
    if($page ==1){
        $prev_page = 1;
    }else{
        $prev_page = $page - 1;
    }
    if($page == $count_page){
        $next_page = $count_page;
    }else{
        $next_page = $page + 1;
    }
    $last_page = $count_page;
    if($page == 1){
        $first_string = "<a href='javascript:;'>首页</>";
        $prev_string = "<a href='javascript:;'>上一页</>";
    }else {
        $first_string = "<a href='?page=$first_page'>首页</>";
        $prev_string = "<a href='?page=$prev_page'>上一页</>";
    }
    $pageoffset = ceil(($page_num-1)/2);
    //$pageoffset = 1;
    $start = 1;
    $end = $count_page;
    if($count_page > $page_num){
        /* if($page>$pageoffset+1){
            $centerStr.="...";
        } */
        if($page>$pageoffset){
            $start = $page - $pageoffset;
            $end = $count_page>$page + $pageoffset ? $page + $pageoffset:$count_page;
        }else {
            $start = 1;
            $end = $count_page > $page_num ? $page_num : $count_page;
        }
        if($page+$pageoffset>$count_page){
            $start = $start -($page + $pageoffset- $end);
        }
    }
    for($i = $start;$i<=$end;$i++){
        if($i == $page){
            $centerStr.="<a class='numa active' href='"."?page=".$i."'>{$i}</a>";
        }else{
            $centerStr.="<a class='numa' href='?page={$i}'>{$i}</a>";
        }
        //$centerStr.="<a href='".$_SERVER["PHP_SELF"]."?page=".$i."'>{$i}</a>";
    }
    //尾部省略号显示
    /* if($count_page>$page_num&&$count_page>$page+$pageoffset){
        $centerStr.="...";
    } */
    if($page == $count_page){
        $last_string ="<a href='javascript:;'>尾页</>";
        $next_string = "<a href='javascript:;'>下一页</>";
    }else{
        $last_string ="<a href='?page=$last_page'>尾页</>";
        $next_string ="<a href='?page=$next_page'>下一页</>";
    }
    $page_string = $first_string.$prev_string.$centerStr.$next_string.$last_string;
    return $page_string;
}
