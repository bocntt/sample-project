@component('mail::message')
  #Registration COnfirmation

  ## Congratulations {{ $user->name }}!

  You have joined our site and now have access to following benefits:
  * instant access
  * 24/7 support
  * updated daily content

  @component('mail::button', ['url' => 'http://www.sample-project.com'])
    Visit Now
  @endcomponent
  Thank, <br>
  {{ config('app.name') }}

  @component('mail::panel', ['url' => ''])
    You are receiving this email because you subscribed to Sample Project.
    You may Unsubscribe by clicking <a href="/unsubscribe">here</a>
  @endcomponent
@endcomponent
