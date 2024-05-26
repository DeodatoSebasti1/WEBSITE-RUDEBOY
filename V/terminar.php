<?php 
 include("cabecalhodashboard.php");
 include("barralateral.php");
require("../C/cabe_sweetalert.php");
 unset($_SESSION["car"]);



?>

<script>

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    cancelButton: 'btn btn-danger',
    confirmButton: 'btn btn-success'

  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Tens a Certeza',
  text: "Que pretendes Terminar a Sessão?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'SIM',
  cancelButtonText: 'NÃO',
  reverseButtons: false
}).then((result) => {
  if (result.isConfirmed) {
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'SESSÃO TERMINADA COM SUCESSO',
            showConfirmButton: false,
            timer: 1500
            })
            setTimeout(function(){
                //direcionar para painel admin 
                window.location.href='destruirsessao.php';
            }, 900);

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
            setTimeout(function(){
                //direcionar para painel admin 
            window.location.href='paineladmin.php';
            }, 200);
  }
})
</script>