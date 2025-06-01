<x-login-layout>
  @if($followingUsers->count() > 0)
    <ul>
      @foreach($followingUsers as $user)
        <li class="flex items-center gap-2">
          <img src="{{ asset('images/' . $user->avatar) }}"  class="w-8 h-8 rounded-full">
          <span>{{ $user->username }}</span>
        </li>
      @endforeach
    </ul>
  @else
    <p>フォロー中のユーザーはいません。</p>
  @endif
</x-login-layout>
