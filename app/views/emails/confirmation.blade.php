A new private message thread has been created on your behalf.

Before this message is sent, please confirm that you wish to send this message.

Name: {{{ $user->name }}}

Email: {{{ $user->email }}}

Subject: {{{ $thread->subject }}}

Message: {{{ $msg->message }}}


<?php $url = $thread->token . '/' . $user->token . '/' . $thread->auth_token; ?>


If you want to send this message, click here: {{ url( 'thread/confirm/' . $url ) }}