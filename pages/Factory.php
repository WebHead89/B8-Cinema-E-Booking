<?php
    // factory class to return the button type to pick a seat in a booking
    class Factory {
        public static function getButton($type, $seatNumIndex) {
            switch($type) {
                case 1: // reserved or unavailable seat
                    return "<button type='button' class='unavailable_seat'></button>";
                case 2: // open seat for selection
                    return "<form name='updateSeat' method='POST'> 
                                <input type='hidden' id='postID' name='postID' value='userAddSeat'>
                                <input type='hidden' id='seatIndex' name='seatIndex' value='$seatNumIndex'>
                                <button type='submit' class='open_seat'></button>
                            </form>";
                case 3: // selected seat
                    return "<form name='updateSeat' method='POST'> 
                                <input type='hidden' id='postID' name='postID' value='userRemoveSeat'>
                                <input type='hidden' id='seatIndex' name='seatIndex' value='$seatNumIndex'>
                                <button type='submit' class='selected_seat'></button>
                            </form>";
            }
            return -1;
        }
    }
// <a href='booking.php?movieID=$movieID' class='open_seat'></a>"
?>