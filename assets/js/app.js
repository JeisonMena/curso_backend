function saveFormData() {
  document.getElementById("btnEnviarTicket").disabled = true;
  const formData = new FormData();

  formData.append("problema", document.getElementById("inputProblema").value);
  formData.append(
    "prioridad",
    document.getElementById("selectPrioridad").value
  );
  formData.append(
    "descripcion",
    document.getElementById("textDescripcion").value
  );
  formData.append("imagen", document.getElementById("inputImagen").files[0]);
  formData.append("cedula", document.getElementById("inputCedula").value);
  formData.append("nombre", document.getElementById("inputNombre").value);
  formData.append("telefono", document.getElementById("inputTelefono").value);
  formData.append("correo", document.getElementById("inputCorreo").value);
  formData.append(
    "departamento",
    document.getElementById("selectDepartamento").value
  );

  fetch("api/ticket.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        Swal.fire({
          title: "Exito!",
          text: data.message,
          icon: "success",
        });
        document.getElementById("formTicket").reset();
      } else {
        Swal.fire({
          title: "Error!",
          text: data.message,
          icon: "error",
        });
      }

      document.getElementById("btnEnviarTicket").disabled = false;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

//mostrar modal y ocultar modal de boostrap 5
function showModal(modalId) {
  var myModal = new bootstrap.Modal(document.getElementById(modalId), {
    keyboard: false,
  });
  myModal.show();
}

function hideModal(modalId) {
  var myModalEl = document.getElementById(modalId);
  var modal = bootstrap.Modal.getInstance(myModalEl);
  modal.hide();
}
