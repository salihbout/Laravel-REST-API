Hello {{$user->name}}
Thanks for creating an account. Please verify you account by clicking in the following link : 
{{ route('verify', $user->verification_token)}}