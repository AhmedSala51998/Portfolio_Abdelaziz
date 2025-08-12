<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'azizmokbel81@gmail.com';
        $mail->Password   = 'kexp eiuu hdxb wmwq';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom($_POST['email'], htmlspecialchars($_POST['name']));
        $mail->addAddress('azizmokbel81@gmail.com');

        $mail->Subject = !empty($_POST['subject']) ? htmlspecialchars($_POST['subject']) : 'New Portfolio Message';

        $logoUrl = 'https://raw.githubusercontent.com/AhmedSala51998/Portfolio_Abdelaziz/master/assets/img/profile/abdelaziz.jpg';

        $body = '
            <div style="background-color: #e6f0fa; padding: 40px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; direction: rtl; text-align: right;">
              <table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width: 600px; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.07);">

                <!-- Header -->
                <tr>
                  <td style="padding: 40px 40px 10px; text-align: center;">
                    <a href="https://myPortfolio.com/" target="_blank">
                      <img src="' . $logoUrl . '" 
                          alt="Portfolio Logo" 
                          style="width: 150px; height: 150px; border: 4px solid #007bff; border-radius: 50%; object-fit: cover; margin-bottom: 20px;">
                    </a>
                    <h1 style="margin: 0; font-size: 22px; font-weight: 700; color: #0056b3;">
                      📩 رسالة جديدة من نموذج الاتصال على الـ Portfolio الخاص بك
                    </h1>
                  </td>
                </tr>

                <!-- Greeting -->
                <tr>
                  <td style="padding: 10px 40px 0;">
                  <p style="font-size: 16px; color: #004085;">مرحبًا،</p>
                  </td>
                </tr>

                <!-- Body Content -->
                <tr>
                  <td style="padding: 10px 40px 0;">
                    <p style="font-size: 16px; color: #004085; line-height: 1.7;">
                      شخص قام بالتواصل معك من خلال نموذج الاتصال الموجود على صفحة الـ <strong>Portfolio / السيرة الذاتية</strong> الخاصة بك بتاريخ <strong>' . date("Y-m-d") . '</strong>.
                    </p>

                    <p style="font-size: 16px; color: #004085; line-height: 1.7; margin-top: 20px;">
                      <strong>الاسم:</strong> ' . htmlspecialchars($_POST['name']) . '<br>
                      <strong>البريد الإلكتروني:</strong> 
                      <a href="mailto:' . htmlspecialchars($_POST['email']) . '" style="color: #007bff; font-weight: bold;">' . htmlspecialchars($_POST['email']) . '</a><br>
                      <strong>الموضوع:</strong> ' . htmlspecialchars($_POST['subject']) . '<br>
                      <strong>رقم الهاتف:</strong> ' . htmlspecialchars($_POST['phone']) . '<br>
                    </p>

                    <p style="font-size: 16px; color: #004085; line-height: 1.7; margin-top: 10px;">
                      <strong>نص الرسالة:</strong><br>
                      <span style="white-space: pre-line;">' . nl2br(htmlspecialchars($_POST['message'])) . '</span>
                    </p>

                    <p style="font-size: 16px; color: #004085; line-height: 1.7; margin-top: 20px;">
                      يُرجى مراجعة الرسالة والرد على المُرسل إذا كانت تهمك.
                    </p>
                  </td>
                </tr>

                <!-- Footer -->
                <tr>
                  <td style="padding: 30px 40px; text-align: center;">
                    <p style="font-size: 15px; color: #6c757d; line-height: 1.6;">
                      تم إرسال هذه الرسالة عبر نموذج "اتصل بي" على صفحة الـ Portfolio الخاصة بك.
                    </p>
                    <p style="font-size: 14px; color: #6c757d;">
                      © ' . date('Y') . ' جميع الحقوق محفوظة لصاحب الـ Portfolio.
                    </p>
                  </td>
                </tr>

              </table>
            </div>
        ';

        $mail->isHTML(true);
        $mail->Body = $body;

        $mail->send();

        echo json_encode([
            'status' => 'success',
            'message' => '✅ Message sent successfully'
        ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => '❌ Failed to send: ' . $mail->ErrorInfo
            ]);
        }

} else {
    echo json_encode([
      'status' => 'error',
      'message' => '❌ طريقة الإرسال غير صحيحة.'
    ]);
}
