<div>
    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="{{ old('nome', $pessoa->nome ?? '') }}">
    @error('nome')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <br><br>
    <label for="idade">Idade:</label>
    <input type="number" name="idade" value="{{ old('idade', $pessoa->idade ?? '') }}">
    @error('idade')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <br><br>
    @auth
        @if(auth()->user()->role === 'admin')
            @isset($usuarios)
                <label for="user_id">Proprietário:</label>
                
                <select name="user_id" id="user_id">
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">
                            {{ $usuario->name }}
                        </option>
                    @endforeach
                </select>
            @endisset
        @endif
    @endauth
</div>