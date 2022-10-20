import React from "react";
import GlobalNavBar from "../GlobalNavBar/GlobalNavBar";
import {useLocation} from 'react-router-dom';
import { Grid } from '@mui/material'
import Seating from "./Seating";


const avatarShowtimesArr = [
    { room: 2, startTime: '22:00', endTime: '23:30' },
    { room: 5, startTime: '23:00', endTime: '24:30' }
]

// Array of objects with seat number and availability
const seatsArr = [
    { number: 1, available: true },
    { number: 2, available: true },
    { number: 3, available: true },
    { number: 4, available: true },
    { number: 5, available: true },
    { number: 6, available: true },
    { number: 7, available: true },
    { number: 8, available: true },
    { number: 9, available: true },
    { number: 10, available: false },
    { number: 11, available: true },
    { number: 12, available: true },
    { number: 13, available: true },
    { number: 14, available: true },
    { number: 15, available: true },
    { number: 16, available: false },
    { number: 17, available: false },
    { number: 18, available: true },
    { number: 19, available: true },
    { number: 20, available: true },
    { number: 21, available: true },
    { number: 22, available: true },
    { number: 23, available: true },
    { number: 24, available: true },
    { number: 25, available: true },
    { number: 26, available: true },
    { number: 27, available: true },
]

const BookingPage = (props) => {

    const location = useLocation();

    const title = location.state.title
    const rating = location.state.rating
    const genre = location.state.genre
    const showtimes = avatarShowtimesArr
    const seats = seatsArr

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
            <Grid container spacing={2}>
                <Grid item xs={7}>
                    <Seating seats={seats} />
                </Grid>
                <Grid item xs={5}>

                </Grid>
            </Grid>
        </div>
    )
}

export default BookingPage