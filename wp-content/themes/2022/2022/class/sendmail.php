<?php

class SendMailClass
{

    private $mail;

    public function __construct()
    {
        require_once 'sendmail/class.phpmailer.php';
        require_once 'sendmail/class.smtp.php';
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0; //neu la 1 = messge + error , neu =2 thi chi co message thôi, 0= se khong hien thi bat ky thong tin phan hoi
        $this->mail->SMTPAuth = TRUE;
        $this->mail->Host = 'smtp.ctcvn.vn';
        $this->mail->Port = '25';
        $this->mail->SMTPSecure = ' ';
        $this->mail->Username = 'admin@ctcvn.vn';
        $this->mail->Password = '#TongHoi2019#';
        // mail nguoi goi
        $this->mail->setFrom('admin@ctcvn.vn', '越南台灣商會聯合總會');
        // mail reply
        $this->mail->addReplyTo(get_option('company_contact_email'), '回復');
        // tieu de mail 
        //$this->mail->Subject = '越南台灣商會聯合總會-會員註冊';
        //thiet lap charset
        $this->mail->CharSet = "utf-8";
        $this->mail->isHTML();
    }


    public function sendMailMemberRegister($mailTo, $name, $user, $password)
    {
        //$subject = '越南台灣商會聯合總會-會員註冊';
        $this->mail->addAddress($mailTo);
        $this->mail->Subject = '越南台灣商會聯合總會-會員註冊';

        $message = '<h2>' . $name . ': 您好 ! </h2> <br>';
        $message .= '<h3> 歡迎您成為"越南台灣商會聯合總會"網頁的會員 </h3>';
        $message .= '<p> 您註冊帳號 :' . $user . ' </p>';
        $message .= '<p> 帳號密碼    :' . $password . ' </p>';
        $message .= '<a href ="http://ctcvn.vn" target="_blank"> 越南台灣商會聯合總會網頁</a><br>';
        $message .= '<a href ="http://ctcvn.vn" target="_blank"> ctcvn.vn</a><br>';
        $message .= '謝謝';

        $this->mail->Body = $message;
        $send = $this->mail->send();
    }

    public function sendMail(array $emailList, array $info, array $detail)
    {

        foreach ($emailList as $val) {
            $this->mail->addAddress($val);
        };

        $mailContent = "<div style='font-size: 1rem; padding:  0.5rem'> <strong> " . __('Order Serial') . " : </strong><i>" . $info['code'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Company Name') . ": </strong><i>" . $info['company'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Full Name') . " : </strong><i>" . $info['name'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Address') . " : </strong><i>" . $info['address'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Phone') . " : </strong><i>" . $info['phone'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('E-mail') . " : </strong><i>" . $info['email'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Payment Methods') . " :</strong><i>" . __($payment) . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Note') . " : </strong><i>" . $info['note'] . "</i></div>";
        $mailContent .= "<div style='font-size: 1rem; padding:  0.5rem'><strong> " . __('Date') . " :</strong><i>" . $info['create_date'] . "</i></div>";
        $mailContent .= "<div style='height:80px'></div>";


        $mailContent .= "<table style=' width:95%'><tr style='height: 50px; background-color:#510000; color: white'>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: center'>" . __('Product Code') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: center'>" . __('MySize') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: center'>" . __('MyColor') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: center'>" . __('Weight') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: center'>" . __('Specifications') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff;text-align: center'>" . __('Quantity') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: center'>" . __('Price') . "</th>";
        $mailContent .= "<th style='border-right: 1px solid #fff;text-align: center'>" . __('Amount') . "</th>";
        $mailContent .= "</tr>";
        foreach ($detail as $val) {
            $mailContent .= "<tr style='height: 50px; border-bottom: 2px solid #666'>";
            $mailContent .= "<td>" . $val['product_serial'] . "</td>";
            $mailContent .= "<td>" . $val['product_size'] . "</td>";
            $mailContent .= "<td>" . $val['product_color'] . "</td>";
            $mailContent .= "<td>" . $val['product_weight'] . "</td>";
            $mailContent .= "<td>" . $val['product_specifi'] . "</td>";
            $mailContent .= "<td style='text-align: center'>" . $val['product_qty'] . "</td>";
            $mailContent .= "<td style='text-align: right'>" . number_format($val['product_price']) . "</td>";
            $mailContent .= "<td style='text-align: right'>" . number_format($val['product_qty'] * $val['product_price']) . "</td>";
            $mailContent .= "</tr>";
        }
        $mailContent .= "<tr style='height: 50px; background-color:#510000; color: white'>";
        $mailContent .= "<th colspan='6'> </th>";
        $mailContent .= "<th  style='border-right: 1px solid #fff; text-align: center'>" . __('Total') . " : </th>";
        $mailContent .= "<th style='border-right: 1px solid #fff; text-align: right'>" . number_format($info['total']) . " VND</th>";
        $mailContent .= "</tr>";
        $mailContent .= "</table>";
        //        echo $mailContent;
        //        die();
        // noi dung email
        $this->mail->Body = $mailContent;
        // send qua smtp
        // goi mail
        $value = $this->mail->send();
        if ($value == FALSE) {
            echo 'the email send failed';
        }

        // send xong xoa đi 
        $this->mail->clearAddresses();
    }

    public function sendAttach(array $mailList, $Content, $Attach)
    {

        //        $myarray = array(
        //            array('email'=>'giaminh0265@yahoo.com'),
        //            array('email'=>'giaminh0265@gmail.com')
        //            );
        foreach ($mailList as $val) {
            // echo $val;
            $this->mail->addAddress($val);
        }
        // $mailContent .= $Content;
        // noi dung email
        $this->mail->Body = $Content;
        // send qua smtp
        // file dinh kem 
        $this->mail->addAttachment($Attach);
        // goi mail
        $value = $this->mail->send();
        //send xong xoa đi 
        $this->mail->clearAddresses();
        $this->mail->clearAttachments();

        if ($value == FALSE) {
            echo "<div style=' margin-left: 20%;height: 300px;margin-top:50px ;text-align: center; 300px; width: 50%; background-color: red;border-bottom: 2px #000 solid; border-radius: 5px'> "
                . "<div><h3 style='color:#fff; font-weight: bold; letter-spacing: 3px; padding-top: 20px;'>電郵發送失敗，請檢查網路，e-mail地址和密碼  </h3><div>"
                . "<div style='margin-top:150px;'><lable onclick='window.history.back()'; style='font-weight: bold; letter-spacing: 5px; color:#666;  padding: 10px 15px; cursor:  pointer; background-color:  #fff;border-radius: 10px'> 返回 </lable><div>"
                . "</div>";
            die();
        }
    }
}
