$wire.intercept('openCreateUser',({action,onSend,onCancel,onFinish,onSuccess,onError,onFailure}) => {
    const el = action?.origin?.el || action.component.el;

    onSend(() => {
      // action.cancel();
      document.body.style.opacity= '0.3';
    });

    onCancel(() => {
      console.log('canceled');
    });

    onSuccess(() => {
      el.classList.add('bg-red-600','p-2','rounded');
    });

    onError(({preventDefault, response}) => {
      preventDefault();

      if(response.status === 500){
        Livewire.dispatchTo('toast','toast',{message:'Ocorreu um erro', icon:'error'})
      }
      console.log('error');
    });

    onFailure(() => {
        console.log('failure');
    });

    onFinish(() => {
      document.body.style.opacity= '1';
    })
  });