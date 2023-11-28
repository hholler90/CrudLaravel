Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($usuario->getEmailForPasswordReset()) }}"> {{ $link }} </a>
