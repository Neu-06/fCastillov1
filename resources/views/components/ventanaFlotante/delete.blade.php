@props([
    'modalId',
    'action',
    'itemName',
    'question' => '¿Estás seguro de eliminar este elemento?',
    'buttonText' => 'Eliminar',
])

<div id="{{ $modalId }}"
    class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h3 class="text-lg font-bold text-red-600 mb-4 text-center">¿Eliminar?</h3>
        <p class="mb-6 text-gray-700 text-center">
            {!! $question !!} <br>
            <span class="font-semibold">{{ $itemName }}</span>
        </p>
        <div class="flex justify-end gap-4">
            <button onclick="closeDeleteModal('{{ $modalId }}')"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                Cancelar
            </button>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showDeleteModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeDeleteModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endpush