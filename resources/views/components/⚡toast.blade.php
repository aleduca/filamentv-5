<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<script>
  this.$on('toast', (data) => {
    Swal.fire({
      toast: true
      , position: 'top-end'
      , icon: data.icon || 'success'
      , title: data.message
      , showConfirmButton: false
      , timer: 3000
      , timerProgressBar: true
    })
  })

</script>

<div>
  {{-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin --}}
</div>
