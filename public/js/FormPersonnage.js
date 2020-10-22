class FormPersonnage {
  constructor () {
    this.form = $('#form')
    this.addPersonnages()
    this.changeValue()
  }

  // FORM SEND WITH AJAX
  addPersonnages () {
    this.form.on('submit', (e) => {
      e.preventDefault()
      const name = $('#input--name').val()
      const image = $('#input--image').val()
      // GET IMAGE FROM INPUT
      const fileData = $('#input--image').prop('files')[0]
      var formData = new FormData()
      formData.append('image', fileData)
      formData.append('name', name)
      // CHECK IF INPUT NOT BLANK
      if (name !== '' && image !== '') {
        $.ajax({
          url: 'index.php?url=addPersonnage',
          type: 'POST',
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: (data) => {
            if (data === 'success') {
              $('.input--picture').val('')
              $('#input--name').val('')
              $('#input--name').css('border-bottom', '1.5px solid #ced4da')
              $('.input--picture').css('border-bottom', '1.5px solid #ced4da')
              $('#content--container').load('?url=content&page=1')
              this.scrollTo($('#content--container'))
            } else if (data === 'error name') {
              $('#input--helper--name').text('Merci de choisir un autre nom')
              $('#input--name').css('animation', 'headshake 100ms cubic-bezier(.4,.1,.6,.9) 2')
              $('#input--name').css('border-bottom', '1.5px solid #b20a37')
            } else {
              $('#input--helper--image').text('Merci de choisir un fichier image au format jpg, png, ou gif et ne dépassant pas 5Mo')
              $('.input--picture').css('border-bottom', '1.5px solid #b20a37')
              $('.input--picture').css('animation', 'headshake 100ms cubic-bezier(.4,.1,.6,.9) 2')
            }
          }
        })
      } else {
        if (name === '') {
          $('#input--name').css('animation', 'headshake 100ms cubic-bezier(.4,.1,.6,.9) 2')
          $('#input--name').css('border-bottom', '1.5px solid #b20a37')
        }
        if ($('#input--image').get(0).files.length === 0) {
          $('.input--picture').css('animation', 'headshake 100ms cubic-bezier(.4,.1,.6,.9) 2')
          $('.input--picture').css('border-bottom', '1.5px solid #b20a37')
        }
      }
    })
  }

  changeValue () {
    $('#input--image').on('change', () => {
      const image = $('#input--image').val()
      const rename = image.replace('C:\\fakepath\\', '')
      $('.input--picture').val(rename)
      $('.input--picture').css('border-bottom', '1.5px solid green')
      $('#input--helper--image').text('')
    })

    $('#input--name').on('change', () => {
      if ($('#input--name').val() === '') {
        $('#input--name').css('border-bottom', '1.5px solid #b20a37')
      } else {
        $('#input--name').css('border-bottom', '1.5px solid green')
        $('#input--helper--name').text('')
      }
    })
  }

  scrollTo (hash) {
    $('html, body').stop().animate({ scrollTop: $(hash).offset().top - 50 }, 300)
  }
}
const form = new FormPersonnage()
