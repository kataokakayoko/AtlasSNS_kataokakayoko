<x-login-layout>
  @if($followers->count() > 0)
    <ul>
      @foreach($followers as $user)
        <li class="flex items-center gap-2">
          <img src="{{ asset('images/' . ($user->avatar ?? 'default_icon.png')) }}" class="w-8 h-8 rounded-full">
          <span>{{ $user->username }}</span>
        </li>
      @endforeach
    </ul>
  @else
    <p>フォロワーはいません。</p>
  @endif
</x-login-layout>
