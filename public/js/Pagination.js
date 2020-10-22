class Pagination {

  loadContent (page) {
    setTimeout(function () {
      $('#content--container').load('?url=content&page=' + page)
    }, 500)
  }

  pageChange (page) {
    this.scrollTo($('#content--container'))
    setTimeout(function () {
      $('#content--container').load('?url=content&page=' + page)
    })
  }

  // SCROLL TO THE TOP OF PERSONNAGES
  scrollTo (hash) {
    $('html, body').stop().animate({ scrollTop: $(hash).offset().top - 150 }, 300)
  }
}
