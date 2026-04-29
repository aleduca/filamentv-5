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
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
              });
          })
        "
    >
      <textarea>
       {{ $getState() }}
      </textarea>
    </div>
</x-dynamic-component>
