Hi {{ $user->full_name }},
<br />
<br />
A new account has been created for you by a site administrator at <a href='{{ url('/') }}'>{{ crminfo('name') }}</a>.
<br />
<br />
Please use the following credentials to sign in:
<br />
Username: <b>{{ $user->username }}</b><br />
Password: <b>{{ $password['plainPassword'] }}</b>
<br />
<br />
Please change your password by visiting your edit account page: <a href='{{ $editAccount = url("users".$user->username."/edit") }}'>{{ $editAccount }}</a><br />
or request a Password Reset Link at: <a href='{{ $resetPassword = url("password/reset") }}'>{{ $resetPassword }}</a>
<br />
<br />
Happy hacking!<br />
{{ crminfo('name') }}
