@props(['expenseCode' => null])

<form method="POST" action="{{ $expenseCode ? route('expense-codes.update', $expenseCode) : route('expense-codes.store') }}">
    @csrf
    @if($expenseCode) @method('PUT') @endif

    <div class="mb-4">
        <x-input-label for="code" value="Kod" />
        <x-text-input id="code" name="code" type="text" class="block w-full mt-1" value="{{ old('code', $expenseCode->code ?? '') }}" required />
    </div>

    <div class="mb-4">
        <x-input-label for="description" value="Deskripsi" />
        <x-text-input id="description" name="description" type="text" class="block w-full mt-1" value="{{ old('description', $expenseCode->description ?? '') }}" required />
    </div>

    <x-primary-button>{{ $expenseCode ? 'Kemas Kini' : 'Simpan' }}</x-primary-button>
</form>
