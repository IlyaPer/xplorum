<?php
  $mailer = new Swift_Mailer($transport);
  $message = (new Swift_Message('Ваша ставка выиграла'))
    ->setFrom([$config['MailTransport'] => $config['MailUsername']])
    ->setTo([$winner['email'], $winner['email'] => $winner['name']])
    ->setBody(include_template('email.php', ['winner' => $winner, 'href' => $config['href']]));
  // Send the message
  $result = $mailer->send($message);
  ?>
