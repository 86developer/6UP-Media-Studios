require("./class.phpmailer.php");
                        require("./class.smtp.php");

                        $mail = new PHPMailer();

                        $mail->IsSMTP();                                      // set mailer to

                        $mail->Host = "huellittas.com.ar";  // specify main and backup server
                        $mail->SMTPAuth = true;     // turn on SMTP authentication
                        $mail->Username = "infofletexpress@huellittas.com.ar";  // SMTP username
                        $mail->Password = "password"; // SMTP password

                        $mail->From = "infofletexpress@huellittas.com.ar";
                        $mail->FromName = "FleteXpress";        // remitente
                        $mail->AddAddress($email, $verificationCode);        // destinatario

                        $mail->AddReplyTo($email, $verificationCode);    // responder a

                        $mail->WordWrap = 50;     // set word wrap to 50 characters
                        $mail->IsHTML(true);     // set email

                        $mail->Subject = "Asunto .....";
                        $mail->Body = "Código de verificación: <b>$verificationCode</b>\n\nPor favor, introduce este código en la página de verificación para completar el proceso. Este código es válido por 5 minutos. Si no has solicitado esta verificación, puedes ignorar este mensaje.\n\nGracias,\nEl equipo de FleteXpress";

                        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

                        if($mail->Send())
                        {
                            // Enviar respuesta al cliente , antes de esto creo en la session la categoria si es chofr o usuario
                            $_SESSION['category']=$categoria;
                            $_SESSION['id']=$evaluar['id'];
                            echo json_encode(array(
                                'ok' => true,
                                'data' => 'usuario',
                                'email'=>$email
                            ));
                            die();
                        }else{
                            echo json_encode(array(
                                'ok' => false, 
                                'data' => '',
                                'email'=>''
                            ));
                            die();
                        }