Thanks for signing up!
<br />
<br />
You are receiving this email because you have recently requested to create an account in Hackerspace CRM.
<br />
<br />
Your username is <b>{{ $user->username }}</b>. To confirm your account and log in, please visit <a href='{{ $link = url("login/confirm/{$user->email_token}") }}'>{{ $link }}</a>.
<br />
<br />
Happy hacking!<br />
Hackerspace CRM
