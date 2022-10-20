import React from "react";
import GlobalNavBar from "../GlobalNavBar/GlobalNavBar";
import {useLocation} from 'react-router-dom';



const avatarShowtimes = [
    { room: 2, startTime: '22:00', endTime: '23:30' },
    { room: 5, startTime: '23:00', endTime: '24:30' }
]

const BookingPage = (props) => {

    const location = useLocation();

    const title = location.state.title
    const rating = location.state.rating
    const genre = location.state.genre
    const showtimes = avatarShowtimes

    console.log(title)
    // Two columns in middle of screen
    // Left col ~60% of screen with seat selection
    // Right col ~40% of screen with showtimes and ticket selection and checkout

    // Structure
    // GlobalNavBar
    // Grid container direction row
    // Left col grid
    //  Custom component for seats
    // Right col grid
    //  Grid container direction column
    //  Top row grid
    //      Custom component for showtimes
    //  Bot row grid
    //      Custom component for ticket selection


    return (
        <div>
            <GlobalNavBar/>
            <p>
                {title}
            </p>

        </div>
    )
}

export default BookingPage