$('.eliminar').submit(function(evento){
    evento.preventDefault();

    Swal.fire({
        title: 'Estas seguro?',
        text: "No podras deshacer los cambios!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '',
        confirmButtonText: 'Si, eliminar!',
        reverseButtons:true,
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});