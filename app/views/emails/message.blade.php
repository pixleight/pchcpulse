A new message has been sent in the topic "{{ $thread->subject }}":

{{ $sender->name }} said:
-----------------

{{ $msg->message }}


<?php $url = $thread->token . '/' . $user->token; ?>


If you would like to reply to this message, and view the rest of the message thread, click here: {{ url( 'thread/' . $url ) }}