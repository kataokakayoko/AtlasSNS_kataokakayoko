<x-login-layout>
  @if (session('success'))
    <div class="text-green-500">{{ session('success') }}</div>
  @endif

  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
      <label for="avatar">プロフィール画像</label><br>
      <input type="file" name="avatar" id="avatar">
      @error('avatar')
        <div class="text-red-500">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">更新</button>
  </form>

  <div class="mt-4">
    <p>現在のアイコン:</p>
    @if(Auth::user()->avatar)
      <img src="{{ asset('images/' . Auth::user()->avatar) }}" alt="現在のアイコン" class="w-20 h-20 rounded-full">
    @else
      <p>アイコン未設定</p>
    @endif
  </div>
</x-login-layout>
