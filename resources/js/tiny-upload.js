export default ($wire) => {
  return (blobInfo, progress) => {

    return new Promise((resolve, reject) => {

      const file = new File(
        [blobInfo.blob()],
        blobInfo.filename(),
        { type: blobInfo.blob().type }
      )

      $wire.upload(
        'temporaryImage',

        file,

        async () => {
          try {
            const url = await $wire.uploadImage()
            resolve(url)
          } catch (e) {
            reject('Erro ao salvar imagem')
          }
        },

        () => reject('Erro no upload'),

        (event) => {
          progress(event.detail.progress)
        }
      )

    })

  }
}