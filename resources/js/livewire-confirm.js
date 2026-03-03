// let confirmInitialized = false;
// Livewire.hook('component.init', ({ component }) => {
//   if(component.el.hasAttribute('wire:confirm') && component.el.hasAttribute('wire:confirm-title')){
//     if(!confirmInitialized){
//       let action = component.el.getAttribute('wire:click');
//       window.confirm = function(message){
//             Swal.fire({
//                   title: component.el.getAttribute('wire:confirm-title') || 'Tem certeza?',
//                   text: message,
//                   icon: 'warning',
//                   showCancelButton: true,
//                   confirmButtonColor: '#22c55e',
//                   cancelButtonColor: 'red',
//                   confirmButtonText: 'Confirm',
//                   cancelButtonText: 'Cancel',
//               }).then((result) => {
//                   if (result.isConfirmed){
//                     component.$wire[action]();
//                   }
//               });
//           }
//       confirmInitialized = true;
//     }
//   }
// })

document.addEventListener('click', async(e) => {
  const button = e.target.closest('[wire\\:confirm-sweet]');
  if(!button) return;

  e.preventDefault();
  e.stopImmediatePropagation();

  const response = await Swal.fire({
        title: button.getAttribute('wire:confirm-sweet-title') || 'Tem certeza?',
        text: button.getAttribute('wire:confirm-sweet') || 'Tem certeza que deseja fazer isso?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#22c55e',
        cancelButtonColor: 'red',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
    });

    if(!response.isConfirmed) return;

    const action = button.getAttribute('wire:click');
    if(!action) return;

    const componentId = button.closest('[wire\\:id]')?.getAttribute('wire:id');
    if(!componentId) return;

    const component = Livewire.find(componentId);

    component.call(action);
},true);