@props([
    'modalId',
    'action',
    'itemName',
    'question' => '¿Estás seguro de restaurar este elemento?',

])

<div id="{{ $modalId }}"
    class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h3 class="text-lg font-bold text-green-600 mb-4 text-center">¿Restaurar?</h3>
        <p class="mb-6 text-gray-700 text-center">
            {!! $question !!} <br>
            <span class="font-semibold">{{ $itemName }}</span>
        </p>
        <div class="flex justify-center gap-4">
            <button onclick="closeRestoreModal('{{ $modalId }}')"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                Cancelar
            </button>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Restaurar
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showRestoreModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeRestoreModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endpush