<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EventBuilder - Lista</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .feedback-container {
            margin-top: 120px;
        }
    </style>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg bg-white border-b border-gray-200 shadow-sm py-3 px-4 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand flex items-center" href="index.html">
                <img src="../img/Logo64.png" alt="EventBuilder Logo">
                <span class="text-lg font-bold text-dark">EventBuilder</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="menu">

                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <a class="text-dark nav-link d-flex align-items-center dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-globe me-2"></i> ES
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="#">Español</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">French</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-outline-light text-dark">Inicia Sesión</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container feedback-container">
        <h4 class="text-center mb-4">Lista De Eventos</h4>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nro</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $file = "../data/json/datos.json";
                if (file_exists($file)) {
                    $datos = json_decode(file_get_contents($file), true);
                    if ($datos && is_array($datos)) {
                        foreach ($datos as $dato) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($dato['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($dato['titulo']) . "</td>";
                            echo "<td>" . htmlspecialchars($dato['fecha']) . "</td>";
                            echo "<td>" . htmlspecialchars($dato['hora']) . "</td>";
                            echo "<td>" . htmlspecialchars($dato['categoria']) . "</td>";
                            echo "<td>" . htmlspecialchars($dato['descripcion']) . "</td>";
                            echo "<td>
                                    <button class='btn btn-warning btn-sm me-2' data-id='{$dato['id']}' onclick='editardato(this)'><i class='fas fa-edit'></i>
                                    </button>
                                    <button class='btn btn-danger btn-sm' data-id='{$dato['id']}' onclick='eliminardato(this)'>
                                        <i class='fas fa-trash-alt'></i>
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No hay datos disponibles</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Archivo de datos no encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formeditar" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="editar-titulo" class="form-label">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-fecha" class="form-label">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-hora" class="form-label">Hora</label>
                            <input type="time" id="hora" name="hora" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-categoria" class="form-label">Categoría</label>
                            <input type="text" id="categoria" name="categoria" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editar-descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editardato(button) {
            const id = parseInt(button.getAttribute('data-id'), 10);

            fetch("../data/json/datos.json")
                .then(response => response.json())
                .then(data => {
                    const entry = data.find(item => item.id === id);

                    if (entry) {
                        document.getElementById("id").value = entry.id;
                        document.getElementById("titulo").value = entry.titulo;
                        document.getElementById("fecha").value = entry.fecha;
                        document.getElementById("hora").value = entry.hora;
                        document.getElementById("categoria").value = entry.categoria;
                        document.getElementById("descripcion").value = entry.descripcion;
                        const editarModalElement = document.getElementById("editarModal");
                        const editarModal = new bootstrap.Modal(editarModalElement);
                        editarModal.show();
                    } else {
                        alert("No se encontró datos.");
                    }
                })
                .catch(error => {
                    alert("Ocurrió un error al cargar los datos.");
                });
        }
    </script>
    <script>
        function eliminardato(button) {
            const id = button.getAttribute('data-id');
            if (confirm('¿Estás seguro de eliminar los datos?')) {
                fetch('eliminar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id
                        }),
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Correcto!! Dato eliminado correctamente.');
                            location.reload();
                        } else {
                            alert('Error al eliminar los datos.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
    <script>
        document.getElementById("formeditar").addEventListener("submit", function (event) {
        event.preventDefault();
        const id = document.getElementById("id").value;
        const titulo = document.getElementById("titulo").value;
        const fecha = document.getElementById("fecha").value;
        const hora = document.getElementById("hora").value;
        const categoria = document.getElementById("categoria").value;
        const descripcion = document.getElementById("descripcion").value;
        const updatedEntry = {
            id: parseInt(id, 10),
            titulo: titulo,
            fecha: fecha,
            hora: hora,
            categoria: categoria,
            descripcion: descripcion
        };
        fetch("editar.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(updatedEntry)
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert("Datos actualizados correctamente.");
                    location.reload();
                } else {
                    alert("Error al actualizar los datos: " + result.message);
                }
            })
            .catch(error => {
                console.error("Error al guardar los datos:", error);
                alert("Ocurrió un error al guardar los datos.");
            });
    });
</script>
    <script src="../assets/js/menu.js"></script>
</body>

</html>