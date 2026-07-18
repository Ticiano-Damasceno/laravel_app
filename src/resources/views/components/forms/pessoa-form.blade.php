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
</div>