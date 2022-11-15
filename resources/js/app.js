import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

if (document.querySelector('#dropzone')) {
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Upload here your image',
        acceptedFiles: '.png, .jpg, .jpeg, .gif',
        addRemoveLinks: true,
        dictRemoveFile: 'Delete file',
        maxFiles: 1,
        uploadMultiples: false,

        init: function () {
            const img = document.querySelector('#image').value
            if (img.trim()) {
                const imgPublished = {}
                imgPublished.size = 1234
                imgPublished.name = img

                this.options.addedfile.call(this, imgPublished)
                this.options.thumbnail.call(this, imgPublished, `/uploads/${imgPublished.name}`)

                imgPublished.previewElement.classList.add('dz-success', 'dz-complete')
            }
        }
    })

    dropzone.on('success', (file, response) => {
        // document.querySelector('[name="image"]').value = response.image;
        document.querySelector('#image').value = response.image;
    })

    dropzone.on('removedfile', () => {
        document.querySelector('#image').value = '';
    })
}


// dropzone.on('error', (file, message) => {
//     console.log(message)
// })
