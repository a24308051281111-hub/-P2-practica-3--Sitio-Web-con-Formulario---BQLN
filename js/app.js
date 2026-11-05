// Calcula el total según la prenda elegida y la cantidad
const cantidad = document.getElementById("cantidad");
const total = document.getElementById("total");
const producto = document.getElementById("producto");

function actualizarTotal() {
  const opcion = producto.selectedOptions[0];
  const precio = opcion ? parseFloat(opcion.dataset.precio) || 0 : 0;
  const n = parseInt(cantidad.value, 10) || 0;
  total.textContent = "$" + (precio * n).toLocaleString("es-MX", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

producto.addEventListener("change", actualizarTotal);
cantidad.addEventListener("input", actualizarTotal);
actualizarTotal();
