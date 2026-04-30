<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <script src="https://cdn.tiny.cloud/1/g6fyqfff3wksyljiamxytie3pyg3rpmsf45d2fpb4ofrrr0u/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <div
        x-data="{ state: $wire.$entangle(@js($getStatePath())) }"
        {{ $getExtraAttributeBag() }}
        x-init="
          $nextTick(() => {
               tinymce.init({
                menubar:false,
                selector: 'textarea',
                target:$refs.editor,
                license_key:'gpl',
                highlight_on_focus:false,
                skin:'oxide-dark',
                plugins: 'link image lists code',
                toolbar: 'blocks | bold italic | bullist numlist | link code',
                content_css:'dark',
                content_style:`
                  body {
                    background-color:#09090b;
                    color:#daffff;
                    font-family:Kode Mono;
                    font-size:16pt;
                  }
                `
              });
          })
        "
    >
      <textarea x-ref="editor">
       {{ $getState() }}
      </textarea>
    </div>
</x-dynamic-component>
