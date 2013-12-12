A new message has been sent in the topic "{{ $thread->subject }}":

{{ $sender->name }} said:

{{ $msg->message }}


<?php $url = $thread->token . '/' . $user->token; ?>

-----------------
@if( $msg->noreply )
The sender did not enter their email address. You are not able to reply to this message.
@else
If you would like to reply to this message, and view the rest of the message thread, click here: {{ url( 'thread/' . $url ) }}
@endif
