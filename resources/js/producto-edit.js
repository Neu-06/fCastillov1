window.eliminarImagen = function (id) {
    const checkbox = document.getElementById(`check-${id}`);
    const contenedor = document.getElementById(`imagen-${id}`);

    if (checkbox && contenedor) {
        checkbox.checked = true;         // ✅ Marcar para enviar al backend
        contenedor.style.display = 'none'; // ✅ Ocultar visualmente
    }
};
