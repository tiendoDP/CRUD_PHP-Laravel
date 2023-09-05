<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\DemoMail;

use Mail;

class MailController extends Controller
{
    public function indexAction() {
        $mailData = [
            "title" => "Heloo Everyone",
            "body" => "Chuyển tới cài đặt cho tài khoản Google của bạn trong ứng dụng hoặc thiết bị mà bạn đang cố gắng thiết lập. 
            Thay thế mật khẩu của bạn bằng mật khẩu gồm 16 ký tự hiển thị bên trên."
        ];

        Mail::to("nguyenvutiendo369@gmail.com")->send(new DemoMail($mailData));
        dd("send mail successfully");
    }
}
