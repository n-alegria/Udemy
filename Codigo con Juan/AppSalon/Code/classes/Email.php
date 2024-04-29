<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;    
        $this->nombre = $nombre;    
        $this->token = $token;    
    }

    public function enviarConfirmacion(){
        // Creo el objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '87949b72f91b33';
        $mail->Password = '4830c77c74c86a';

        $mail->setFrom('cuentas@salon.com');
        $mail->addAddress('cuentas@salon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Habilito HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $contenido = '<html>';
        $contenido .= '<p><strong>Hola: ' . $this->nombre . '</strong> Has creado tu cuenta en AppSalo, solo debes confirmarla presionando el siguiente enlace.</p>';
        $contenido .= '<p>Presiona aqui: <a href="http://localhost:3000/confirmar-cuenta?token=' . $this->token . '">Confirmar Cuenta</a></p>';
        $contenido .= '<p>Si no solicitaste esta cuenta, ignora el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarInstrucciones(){
        // Creo el objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '87949b72f91b33';
        $mail->Password = '4830c77c74c86a';

        $mail->setFrom('cuentas@salon.com');
        $mail->addAddress('cuentas@salon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu password';

        // Habilito HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $contenido = '<html>';
        $contenido .= '<p>Hola: <strong>' . $this->nombre . '</strong>. Has solicitado reestablecer tu password, sigue el siguente enlace para hacerlo..</p>';
        $contenido .= '<p>Presiona aqui: <a href="http://localhost:3000/recuperar?token=' . $this->token . '">Reestablecer password</a></p>';
        $contenido .= '<p>Si no solicitaste esta cuenta, ignora el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->send();
    }
}