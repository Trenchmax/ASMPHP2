<?php

namespace Src\Helpers\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mailer
{
    public static function sendOrderEmail($email, $name, $order_id, $total_price, $products)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'haodcpc08550@gmail.com';   
            $mail->Password = 'hbep adxt vqlk hovt';  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('haodcpc08550@gmail.com', 'Maxstore');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = "Xác nhận đơn hàng #$order_id";

            $productList = "<ul>";
            foreach ($products as $product) {
                $productList .= "<li>{$product['product_name']} - SL: {$product['quantity']} - Giá: " . number_format($product['product_price']) . " VND</li>";
            }
            $productList .= "</ul>";

            $mail->Body = "<h3>Chào $name,</h3>
                           <p>Cảm ơn bạn đã đặt hàng. Đây là thông tin đơn hàng:</p>
                           <p><strong>Mã đơn hàng:</strong> #$order_id</p>
                           <p><strong>Tổng tiền:</strong> " . number_format($total_price) . " VND</p>
                           <p><strong>Sản phẩm:</strong> $productList</p>
                           <p>Shop sẽ sớm giao hàng cho bạn!</p>";

            $mail->AltBody = "Xác nhận đơn hàng #$order_id - Tổng tiền: " . number_format($total_price) . " VND.";

            if ($mail->send()) {
                error_log(" Email đã gửi thành công đến: $email");
                return true;
            } else {
                echo 2;

                error_log(" Gửi email thất bại: " . $mail->ErrorInfo);
                return false;
            }
        } catch (Exception $e) {
            echo 3;

            error_log(" Lỗi PHPMailer: " . $e->getMessage());
            return false;
        }
    }
    public static function sendEmail($to, $toName, $subject, $body) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'haodcpc08550@gmail.com';
            $mail->Password = 'hbep adxt vqlk hovt';  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('haodcpc08550@gmail.com', 'Website của bạn');
            $mail->addAddress($to, $toName);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
    
            return $mail->send();
        } catch (Exception $e) {
            error_log("Lỗi gửi email: " . $mail->ErrorInfo);
            return false;
        }
    }
    
}
