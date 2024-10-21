$(document).ready(function () {
  // Global Settings
  let edit = false;

  // Testing Jquery
  console.log('jquery is working!');
  fetchTasks();
  $('#task-result').hide();


  // search key type event
  $('#search').keyup(function () {
   
    if ($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'src/user-search.php',
        data: { search },
        type: 'POST',
        success: function (response) {

          if (!response.error) {
            let users = JSON.parse(response);
            let template = '';
            users.forEach(user => {
              template += `
                <li userID="${user.id}"><a href="#" class="task-item">${user.nombre} (${user.mail}) - ID: ${user.id}</a></li>
              `;
            });
            
            $('#task-result').show();
            $('#container').html(template);
          }
        }
      })
    }
  });

  //Accion cliente alta 

  $('#altaForm').submit(e => {
    e.preventDefault();
    const fechaIN = new Date($('#fechaIN').val());
    const fechaOUT = new Date($('#fechaOUT').val());
    if (fechaIN >= fechaOUT) {
      alert("La fecha de entrada debe ser menor que la fecha de salida.");
      return;
    }

    const postData = {
      id: $('#userID').val(),
      nombre: $('#nombre').val(),
      email: $('#email').val(),
      fechain: $('#fechaIN').val(),
      fechaout: $('#fechaOUT').val(),
      experiencia: $('input[name="experiencia"]:checked').val(),
      proyecto: $('input[name="proyecto"]:checked').val(),
      status: $('input[name="status"]:checked').val(),
      ubicacion: $('#ubicacion').val(),
      coordinador: $('#coordinador').val(),
      permisos: $('#permisos').val(),
      renovacion: $('#renovacion').val(),
      conocimientos: $('#conocimientos').val(),
      observaciones: $('#observaciones').val()

    };
    console.log(postData);
    const url = edit === false ? 'src/user-add.php' : 'src/user-edit.php';

    console.log(postData, url);
    $.post(url, postData, (response) => {
      console.log(response);
      $('#altaForm').trigger('reset');
      fetchTasks();
    });
  });


  // Get a Single Task by Id 
  $(document).on('click', '.task-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr('userID');
    $.post('src/user-single.php', { id }, (response) => {
      console.log(response);
      const user = JSON.parse(response);

      $('#userID').val(user.id);
      $('#nombre').val(user.nombre);
      $('#email').val(user.mail);
      $('#fechaIN').val(user.fechain);
      $('#fechaOUT').val(user.fechaout);
      $('#experiencia').val(user.experiencia);
      $('#proyecto').val(user.proyecto);
      $('#status').val(user.status);
      $('#ubicacion').val(user.ubicacion);
      $('#coordinador').val(user.coordinador);
      $('#permisos').val(user.permisos);
      $('#renovacion').val(user.renovacion),
        $('#conocimientos').val(user.conocimientos),
        $('#observaciones').val(user.observaciones);


      $('input[name="experiencia"][value="' + user.experiencia + '"]').prop('checked', true);

      $('input[name="proyecto"][value="' + user.proyecto + '"]').prop('checked', true);
      $('input[name="status"][value="' + user.status + '"]').prop('checked', true);
      $('#renovacion').prop('checked', user.renovacion === 'si');

      edit = true;
    });
    e.preventDefault();
  });

  //Borrar usuario 
  $(document).on('click', '.userDelete', (e) => {
    if (confirm('Are you sure you want to delete it?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('userID');
      $.post('src/user-delete.php', { id }, (response) => {
        fetchTasks();
      });
    }
  });

  //Limpiar Formulario
  $(document).on('click', '#limpiar', (e) => {
    e.preventDefault();
    $('#altaForm').trigger('reset');
  })
  //Asignar usuarios  
  function fetchTasks() {
    $.ajax({
      url: 'src/user-list.php',
      type: 'GET',
      success: function (response) {
        const users = JSON.parse(response);
        let template = '';
        users.forEach(user => {
          template += `
                        <tr userID="${user.id}">
                        <td>${user.id}</td>
                        <td>
                        <a href="#" class="task-item">
                          ${user.nombre} 
                        </a>
                        </td>
                        <td>${user.mail}</td>
                        <td>${user.fechain}</td>
                        <td>${user.fechaout}</td>
                        <td>${user.coordinador}</td>
                        <td>
                          <button class="userDelete btn btn-danger">
                           Delete 
                          </button>
                        </td>
                        </tr>
                      `
        });
        $('#users').html(template);
      }
    });
  }

});