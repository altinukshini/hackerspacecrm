Dear Hackerspace CRM member,
<br />
<br />
You've requested to reset your password via the password reset form.
<br />
Please click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
<br />
<br />
Cheers,
Hackerspace CRM
