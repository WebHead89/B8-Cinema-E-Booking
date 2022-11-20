class movieCard extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {

    // ADD ID TO END OF MOVIE INFO HTML TO MAKE IT UNIQUE FOR EACH MOVIE

    var imgSrc = this.attributes.imgSrc.value
    var title = this.attributes.title.value
    var rating = this.attributes.rating.value
    var id = this.attributes.id.value
    var genre = this.attributes.genre.value
    var playing = this.attributes.playing.value
    var disabled = this.attributes.disabled.value


      this.innerHTML = `
    <div class="card text-center">
        <img class="card-img-top" src="${imgSrc}" alt="Avatar">
        <div class="card-body">
            <h5 class="card-title">${title} (${rating})</h5>
            <div class="row">
            <div class="col-md-2"></div>
              <div class="col-md-4">
                <a href="booking.php?${id}" class="btn btn-primary">Buy Tickets</a>
              </div>
              <div class="col-md-4">
                <form action="movieinfo.php" method="POST">
                  <input type="hidden" id="movieID" name="movieID" value=${id}>
                  <button class="btn btn-primary" type="submit">View Info</button>
                </form>
              </div>
            </div>
        </div>
    </div>
    `;
    }
  

  attributeChangedCallback(oldValue, newValue) {
    console.log('Custom element attributes changed.');
    updateStyle(this);
  }

}


customElements.define("movie-card", movieCard);
