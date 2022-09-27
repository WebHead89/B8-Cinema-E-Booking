
var selected_seat_counter = 0

// Need to add checking functionality for if a seat is already taken
function selectSeat(seatId) {
    var element = document.getElementById(seatId)
    element.classList.toggle("selected_seat")
    selected_seat_counter = selected_seat_counter + 1
}