<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
    <form id="formulario">
        <p>Ingrese un caracter letra:</p>
        <input type="text" name="letra" id="texto"/>
        <input type="submit" id="aceptar" name="aceptar" value="Buscar">
    </form>
    <div id="resultado"></div>
    <script>
        $(document).ready(function() {
            $("#formulario").submit(function(event) {
                event.preventDefault(); // Evita que el formulario se envíe de forma convencional

                var valor = $("#texto").val();

                if (valor.length == 0) {
                    alert("Inserte un valor");
                } else if (!sonLetra(valor)) {
                    alert("Inserte una letra");
                } else {
                    // Realizar la solicitud AJAX para buscar libros
                    $.ajax({
                        url: `api.php?action=get_listado_libros&busqueda=${valor}`, // Reemplaza 'tu_script.php' con la URL de tu script PHP que maneja la búsqueda de libros
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                          
                            mostrarLibros(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });

        function sonLetra(texto) {
            var regex = /^[a-zA-Z]+$/;
            return regex.test(texto);
        }

        function mostrarLibros(libros) {
            var resultadoHTML = '<ul>';
            libros.forEach(function(libro) {
                resultadoHTML += '<li>' + libro.titulo + '</li>';
            });
            resultadoHTML += '</ul>';
            $("#resultado").html(resultadoHTML);
        }
    </script>
</body>
</html>
