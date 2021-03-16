<?php
    function public_url($url ='')
    {
        return base_url('public/'.$url);
    }

    function publics($url='')
    {
        return base_url('publics/'.$url);
    }

    function pre($data, $exit = true)
    {
        echo"<pre>";
        print_r($data);

        if($exit)
        {
            die;
        }
    }

    function safe_title($str = '')
    {
        $str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
        $filter_in = array('#(a|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', '#(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#', '#(e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#', '#(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#', '#(i|ì|í|ị|ỉ)#', '#(I|ĩ|Ì|Í|Ị|Ỉ|Ĩ)#', '#(o|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#', '#(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#', '#(u|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#', '#(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#', '#(y|ỳ|ý|ỵ|ỷ|ỹ)#', '#(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)#', '#(d|đ)#', '#(D|Đ)#');
        $filter_out = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'y', 'Y', 'd', 'D');
        $text = preg_replace($filter_in, $filter_out, $str);
        $text = preg_replace('/[^a-zA-Z0-9]/', ' ', $text);
        $text = trim(preg_replace('/ /', '-', trim(strtolower($text))));
        $text = preg_replace('/--/', '-', $text);
        $text = preg_replace('/--/', '-', $text);
        return preg_replace('/--/', '-', $text);
    }


    function the_excerpt($text)
    {
       
        if(strlen($text)> 300)
        {
            $cutstring = substr($text,0,300);
            $word = substr($text,0,strrpos($cutstring,' '));
            return $word ;
        }
        else
        {
            return $text;
        }

    }

    function the_excerpts($text)
    {
       
        if(strlen($text)>50)
        {
            $cutstring = substr($text,0,50);
            $word = substr($text,0,strrpos($cutstring,' '));
            return $word ;
        }
        else
        {
            return $text;
        }

    }


    
    // include('class.smtp.php');
    // include "class.phpmailer.php"; 
    // include "functions.php"; 
    // $title = 'Hướng dẫn gửi mail bằng phpmailer';
    // $content = '';
    // $nTo = '';
    // $mTo = '@gmail.com';
    // $diachicc = 'xcc@gmail.com';
    // //test gui mail
    // $mail = sendMail($title, $content, $nTo, $mTo,$diachicc='');
    // if($mail==1)
    // echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
    // else echo 'Co loi!';
    /**
     * gủi gmail   
     * @param  [type] $title    [description]
     * @param  [type] $content  [description]
     * @param  [type] $nTo      [description]
     * @param  [type] $mTo      [description]
     * @param  string $diachicc [description]
     * @return [type]           [description]
     */
    function sendMail($title, $content, $nTo, $mTo,$diachicc='')
    {
        $nFrom ='Nguyễn Hoàng Hưng';//mail duoc gui tu dau,
        $mFrom = 'hoanghungnguyen03@gmail.com';  //dia chi email  
        $mPass = 'Madjoker95+';       //mat khau email 
        $mail             = new PHPMailer();
        $body             = $content;
        $mail->IsSMTP(); 
        $mail->CharSet   = "utf-8";
        $mail->SMTPDebug  = 0;                    // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";        
        $mail->Port       = 465;
        $mail->Username   = $mFrom;  // GMAIL username
        $mail->Password   = $mPass;               // GMAIL password
        $mail->SetFrom($mFrom, $nFrom);
        //chuyen chuoi thanh mang
        $ccmail = explode(',', $diachicc);
        $ccmail = array_filter($ccmail);
        if(!empty($ccmail)){
            foreach ($ccmail as $k => $v) {
                $mail->AddCC($v);
            }
        }
        $mail->Subject    = $title;
        $mail->MsgHTML($body);
        $address = $mTo;
        $mail->AddAddress($address, $nTo);
        $mail->AddReplyTo('info@freetuts.net', 'Freetuts.net');
        if(!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }
     
    function sendMailAttachment($title, $content, $nTo, $mTo,$diachicc='',$file,$filename)
    {
        $nFrom ='Nguyễn Hoàng Hưng';//mail duoc gui tu dau, 
        $mFrom = 'hoanghungnguyen03@gmail.com';  //dia chi email 
        $mPass = 'Madjoker95+';       //mat khau email cua ban
        $mail             = new PHPMailer();
        $body             = $content;
        $mail->IsSMTP(); 
        $mail->CharSet   = "utf-8";
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";        
        $mail->Port       = 465;
        $mail->Username   = $mFrom;  // GMAIL username
        $mail->Password   = $mPass;               // GMAIL password
        $mail->SetFrom($mFrom, $nFrom);
        //chuyen chuoi thanh mang
        $ccmail = explode(',', $diachicc);
        $ccmail = array_filter($ccmail);
        if(!empty($ccmail)){
            foreach ($ccmail as $k => $v) {
                $mail->AddCC($v);
            }
        }
        $mail->Subject    = $title;
        $mail->MsgHTML($body);
        $address = $mTo;
        $mail->AddAddress($address, $nTo);
        $mail->AddReplyTo('info@freetuts.net', 'Freetuts.net');
        $mail->AddAttachment($file,$filename);
        if(!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }

    function rand_string($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        $str = '';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[rand(0,$size - 1)];
         }
        return $str;
    }


    function supperAdmin($roles,$url = '')
    {
        if($roles != 1){
            return 1;
        }
        
    }

    function admin($roles,$url = ''){

        if($roles != 1 && $roles != 2 )
        {
            return 1;
        }

        

        
    }


?>