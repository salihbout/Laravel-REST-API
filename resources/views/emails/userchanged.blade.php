Hello {{$user->name}}
You have changed your email, the new email should be verified To verify it please click on the following link :
{{route('verify', $user->verification_token)}}